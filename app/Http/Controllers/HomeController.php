<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Show home page
     */
    public function index()
    {
        // Get slider images
        $sliderImages = $this->getSliderImages();
        
        return view('home', compact('sliderImages'));
    }

    /**
     * Show home page admin panel
     */
    public function admin()
    {
        $sliderImages = $this->getSliderImages();
        
        return view('auth.admin.home-settings', compact('sliderImages'));
    }

    /**
     * Upload slider image
     */
    public function uploadSlider(Request $request)
    {
        $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('slider');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image->move($uploadPath, $imageName);
            
            // Save image info to JSON file
            $this->saveSliderInfo($imageName, $request->title, $request->description);
            
            return redirect()->back()->with('success', 'Slider image uploaded successfully!');
        }
        
        return redirect()->back()->with('error', 'Failed to upload image!');
    }

    /**
     * Delete slider image
     */
    public function deleteSlider(Request $request)
    {
        $imageName = $request->image_name;
        
        // Delete file
        $imagePath = public_path('slider/' . $imageName);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        // Remove from JSON
        $this->removeSliderInfo($imageName);
        
        return redirect()->back()->with('success', 'Slider image deleted successfully!');
    }

    /**
     * Get slider images from directory and JSON file
     */
    private function getSliderImages()
    {
        $sliderPath = public_path('slider');
        $jsonPath = public_path('slider/slider-info.json');
        
        $images = [];
        $imageInfo = [];
        
        // Load image info from JSON
        if (file_exists($jsonPath)) {
            $imageInfo = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        
        if (is_dir($sliderPath)) {
            $files = scandir($sliderPath);
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file,
                        'url' => asset('slider/' . $file),
                        'title' => $imageInfo[$file]['title'] ?? '',
                        'description' => $imageInfo[$file]['description'] ?? '',
                        'uploaded_at' => $imageInfo[$file]['uploaded_at'] ?? date('Y-m-d H:i:s', filemtime($sliderPath . '/' . $file))
                    ];
                }
            }
        }
        
        // Sort by upload time (newest first)
        usort($images, function($a, $b) {
            return strtotime($b['uploaded_at']) - strtotime($a['uploaded_at']);
        });
        
        return $images;
    }

    /**
     * Save slider image info to JSON file
     */
    private function saveSliderInfo($imageName, $title = null, $description = null)
    {
        $jsonPath = public_path('slider/slider-info.json');
        
        $imageInfo = [];
        if (file_exists($jsonPath)) {
            $imageInfo = json_decode(file_get_contents($jsonPath), true) ?? [];
        }
        
        $imageInfo[$imageName] = [
            'title' => $title,
            'description' => $description,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];
        
        file_put_contents($jsonPath, json_encode($imageInfo, JSON_PRETTY_PRINT));
    }

    /**
     * Remove slider image info from JSON file
     */
    private function removeSliderInfo($imageName)
    {
        $jsonPath = public_path('slider/slider-info.json');
        
        if (file_exists($jsonPath)) {
            $imageInfo = json_decode(file_get_contents($jsonPath), true) ?? [];
            
            if (isset($imageInfo[$imageName])) {
                unset($imageInfo[$imageName]);
                file_put_contents($jsonPath, json_encode($imageInfo, JSON_PRETTY_PRINT));
            }
        }
    }
} 