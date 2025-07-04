<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CrudService
{
    public function create($modelName, $data)
    {
        $modelClass = "App\\Models\\$modelName";

        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Model $modelClass not found.");
        }

        if (isset($data['title'])) {
            $data['slug'] = $this->generateSlug($data['title'], $modelClass);
        }

        if (isset($data['jp_title'])) {
            $data['jp_slug'] = $this->generateJapaneseSlug($data['jp_title'], $modelClass);
        }

        if (isset($data['np_title'])) {
            $data['np_slug'] = $this->generateNepaliSlug($data['np_title'], $modelClass);
        }

        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image'], $modelClass);
        }

        if (isset($data['image2'])) {
            $data['image2'] = $this->uploadImage2($data['image2'], $modelClass);
        }

        return $modelClass::create($data);
    }

    public function update($modelName, $id, $data)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::findOrFail($id);

        if (isset($data['image'])) {
            $this->deleteImageIfExists($model->image);
            $data['image'] = $this->uploadImage($data['image'], $modelClass); // Fix here
        }

        if (isset($data['image2'])) {
            $this->deleteImage2IfExists($model->image2);
            $data['image2'] = $this->uploadImage2($data['image2'], $modelClass); // Fix here
        }

        if (isset($data['images']) && is_array($data['images'])) {
            $uploadedImages = [];
            foreach ($data['images'] as $image) {
                $uploadedImages[] = $this->uploadImage($image, $modelClass); // Fix here
            }
            $data['images'] = $uploadedImages;
        }

        if (isset($data['video'])) {
            $data['video'] = $data['video'];
        }

        if (isset($data['pdf'])) {
            $this->deletePdfIfExists($model->pdf);
            $pdfDetails = $this->uploadPdf($data['pdf']);
            $data['pdf'] = $pdfDetails['name'];
            $data['pdf_size'] = $pdfDetails['size'];
        }

        if (isset($data['title'])) {
            $data['slug'] = $this->generateSlug($data['title'], $modelClass);
        }

        if (isset($data['jp_title'])) {
            $data['jp_slug'] = $this->generateJapaneseSlug($data['jp_title'], $modelClass);
        }

        if (isset($data['np_title'])) {
            $data['np_slug'] = $this->generateNepaliSlug($data['np_title'], $modelClass);
        }

        $model->fill($data)->save();

        return $model;
    }


    public function delete($modelName, $id)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::findOrFail($id);

        if (isset($model->image)) {
            $this->deleteImageIfExists($model->image);
        }

        if ($model->pdf) {
            $this->deletePdfIfExists($model->pdf);
        }

        $model->delete();

        return true;
    }

    public function find($modelName, $id)
    {
        $modelClass = "App\\Models\\$modelName";
        return $modelClass::findOrFail($id);
    }

    public function all($modelName)
    {
        $modelClass = "App\\Models\\$modelName";
        return $modelClass::latest()->get();
    }

    public function uploadImage($image)
{
    try {
        // Check if the uploaded file is actually an image
        if (!$image->isValid() || !in_array($image->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            throw new \Exception("Invalid image file.");
        }

        $destinationPath = 'uploads/images/';
        $imageName = uniqid(date('YmdHis') . "_", true) . "." . $image->getClientOriginalExtension();

        if ($image->move($destinationPath, $imageName)) {
            return $imageName;
        } else {
            throw new \Exception("Image upload failed.");
        }
    } catch (\Exception $e) {
        Log::error('Error uploading image: ' . $e->getMessage());
        throw new \Exception("The image failed to upload.");
    }
}


    public function uploadImage2($image2)
    {
        $destinationPath = 'uploads/images2/';
        $imageName = uniqid(date('YmdHis') . "_", true) . "." . $image2->getClientOriginalExtension();
        $image2->move($destinationPath, $imageName);
        return $imageName;
    }

    public function uploadPdf($pdf)
    {
        $destinationPath = 'uploads/pdfs/';
        $pdfName = date('ymdHis') . "." . $pdf->getClientOriginalExtension();
        $pdf->move($destinationPath, $pdfName);

        $pdfSize = round(filesize($destinationPath . $pdfName) / 1024, 2);

        return ['name' => $pdfName, 'size' => $pdfSize];
    }

    public function deleteImageIfExists($imageName)
    {
        if ($imageName) {
            $imagePath = 'uploads/images/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    public function deleteImage2IfExists($imageName)
    {
        if ($imageName) {
            $imagePath = 'uploads/images2/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    public function deletePdfIfExists($pdfName)
    {
        if ($pdfName) {
            $pdfPath = 'uploads/pdfs/' . $pdfName;
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }
    }

    // Default slug generator for 'title' → 'slug'
    public function generateSlug($title, $modelClass)
    {
        $slug = $this->str_slug($title);
        $count = 1;
        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = $this->str_slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Japanese slug generator
    public function generateJapaneseSlug($title, $modelClass)
    {
        $slug = $this->str_slug_japanese($title);
        $count = 1;
        while ($modelClass::where('jp_slug', $slug)->exists()) {
            $slug = $this->str_slug_japanese($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Nepali slug generator
    public function generateNepaliSlug($title, $modelClass)
    {
        $slug = $this->str_slug_nepali($title);
        $count = 1;
        while ($modelClass::where('np_slug', $slug)->exists()) {
            $slug = $this->str_slug_nepali($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Default slug helper (English/Latin)
    public function str_slug($title, $separator = '-')
    {
        $title = preg_replace('/[^\x20-\x7E]/u', '', $title);
        $title = strtolower($title);
        $title = preg_replace('/\s+/', $separator, $title);
        return trim($title, $separator);
    }

    // Japanese slug helper
    public function str_slug_japanese($title, $separator = '-')
    {
        // Keep Unicode letters/numbers (including Japanese characters), remove other symbols
        $slug = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title);
        $slug = preg_replace('/\s+/u', $separator, trim($slug));
        return mb_strtolower($slug);
    }

    // Nepali slug helper
    public function str_slug_nepali($title, $separator = '-')
    {
        // Keep Unicode letters/numbers (including Nepali characters), remove other symbols
        $slug = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title);
        $slug = preg_replace('/\s+/u', $separator, trim($slug));
        return mb_strtolower($slug);
    }

    public function toggleStatus($modelName, $id)
    {
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::findOrFail($id);
        $model->status = !$model->status;
        $model->save();

        return $model;
    }
}
