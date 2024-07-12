<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'parent_name' => $category->parent ? $category->parent->name : null,
            ];
        });
    
        return view('categories.index', compact('categories'));
    }
    

    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.edit', compact('category', 'categories'));
    }
    public function show()
    {
       //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

    public function export()
    {
        // Fetch all categories and store them in a JSON file
        $categories = Category::all();
        $fileName = 'categories.json';
        Storage::put($fileName, $categories->toJson());

        // Define the full path to the JSON file and ZIP file
        $jsonFilePath = storage_path('app/' . $fileName);
        $zipFileName = 'categories.zip';
        $zipFilePath = storage_path($zipFileName);

        // Create the ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($jsonFilePath, $fileName);
            $zip->close();
        } else {
            return response()->json(['error' => 'Could not create ZIP file'], 500);
        }

        // Return the ZIP file as a download response
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function importCategory()
    {

        return view('categories.import');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:zip',
        ]);

        $file = $request->file('file');
        $zip = new ZipArchive();

        if ($zip->open($file) === TRUE) {
            $zip->extractTo(storage_path());
            $zip->close();

            $json = Storage::get('categories.json');
            $categories = json_decode($json, true);

            foreach ($categories as $categoryData) {

                Category::updateOrCreate([
                    'id' => $categoryData['id'],
                    'name' => $categoryData['name'],
                    'parent_id' => $categoryData['parent_id'],
                ]);
            }
            
        }

        return redirect()->route('categories.index');
    }

    public function ajaxGetCategory(Request $req)
    {
        $cat_id = $req->cat_id;
        $sub_category = DB::table('categories')->where('parent_id', $cat_id)->get();
        if (isset($sub_category[0]->id)) {
            echo "<option value=''>Select..</option>";
            foreach ($sub_category as $value) {
                echo "<option value='$value->id'>$value->name</option>";
            }
        } else {
            echo "<option value=''>Not Found!</option>";
        }
    }
}

