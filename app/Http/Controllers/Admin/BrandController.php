<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc là ảnh
        ], [
            'name.required' => 'Tên thương hiệu không được để trống.',
            'name.unique' => 'Thương hiệu này đã tồn tại.',
            'logo.image' => 'File tải lên phải là hình ảnh.',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        // --- XỬ LÝ UPLOAD LOGO ---
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Đặt tên file: thời gian_tên gốc (ví dụ: 171123456_nike.jpg)
            $filename = time() . '_' . $file->getClientOriginalName();
            // Di chuyển vào public/uploads/brands
            $file->move(public_path('uploads/brands'), $filename);
            
            // Lưu đường dẫn vào mảng data
            $data['logo'] = 'uploads/brands/' . $filename;
        }

        Brand::create($data);

        return redirect()->route('brands.index')->with('success', 'Thêm thương hiệu thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:255|unique:brands,name,'.$brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
        'name.unique' => 'Thương hiệu này đã tồn tại!',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        // --- XỬ LÝ UPLOAD LOGO MỚI ---
        if ($request->hasFile('logo')) {
            // 1. Xóa ảnh cũ nếu có
            if ($brand->logo && File::exists(public_path($brand->logo))) {
                File::delete(public_path($brand->logo));
            }

            // 2. Upload ảnh mới
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/brands'), $filename);
            $data['logo'] = 'uploads/brands/' . $filename;
        }

        $brand->update($data);

        return redirect()->route('brands.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->logo && File::exists(public_path($brand->logo))) {
            File::delete(public_path($brand->logo));
        }

        $brand->delete();
        
        return redirect()->route('brands.index')->with('success', 'Đã xóa thương hiệu!');
    }
}
