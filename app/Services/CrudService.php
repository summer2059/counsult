<?php

namespace App\Services;

class CrudService{
    public function create($modelName, $data){
        $modelClass = "App\\Models\\$modelName";

        if(!class_exists($modelClass)){
            throw new \InvalidArgumentException("Model $modelClass not found.");
        }

        if(isset($data['title'])){
            $data['slug'] = $this->generateSlug($data['title'], $modelClass);
        }

        if(isset($data['image'])){
            $data['image'] = $this->uploadImage($data['image'], $modelClass);
        }
        if(isset($data['image2'])){
            
            $data['image2'] = $this->uploadImage2($data['image2'], $modelClass);
        }

        return $modelClass::create($data);
    }

    public function update($modelName, $id, $data){
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::findOrFail($id);

        if (isset($data['image'])){
            $this->deleteImageIfExists($model->image);
            $data['image'] = $this->uploadImage($data['image']);
        }
        if (isset($data['image2'])){
            $this->deleteImage2IfExists($model->image2);
            $data['image2'] = $this->uploadImage2($data['image2']);
        }

        if(isset($data['images']) && is_array($data['images'])){
            $data['images'] = [];
            foreach ($data['images'] as $image) {
                $data['images'][] = $this->uploadImage($image);
            }
        }

        if(isset($data['video'])){
            $data['video'] = $data['video'];
        }

        if(isset($data['pdf'])){
            $this->deletePdfIfExists($model->pdf);
            $pdfDetails = $this->uploadPdf($data['pdf']);
            $data['pdf'] = $pdfDetails['name'];
            $data['pdf_size'] = $pdfDetails['size'];
        }

        $model->fill($data)->save();

        return $model;
    }

    public function delete($modelName, $id){
        $modelClass = "App\\Models\\$modelName";
        $model = $modelClass::findOrFail($id);

        if (isset($model->image)){
            $this->deleteImageIfExists($model->image);
        }

        if($model->pdf){
            $this->deletePdfIfExists($model->pdf);
        }
        
        $model->delete();

        return true;
    }

    public function find($modelName, $id){
        $modelClass = "App\\Models\\$modelName";
        return $modelClass::findOrFail($id);

    }

    public function all($modelName){
        $modelClass = "App\\Models\\$modelName";
        return $modelClass::latest()->get();
    }

    public function uploadImage($image){
        $destinationPath = 'uploads/images/';
        $imageName = uniqid(date('YmdHis') . "_", true) . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
    }

    public function uploadImage2($image2){
       
        $destinationPath = 'uploads/images2/';
        $imageName = uniqid(date('YmdHis') . "_", true) . "." . $image2->getClientOriginalExtension();
        $image2->move($destinationPath, $imageName);
        return $imageName;
    }

    public function uploadPdf($pdf){
        $destinationPath = 'uploads/pdfs/';
        $pdfName = date('ymdHis') . "." . $pdf->getClientOriginalExtension();
        $pdf->move($destinationPath, $pdfName);

        $pdfSize = round(filesize($destinationPath . $pdfName) / 1024, 2);

        return['name' => $pdfName, 'size' => $pdfSize];
    }

    public function deleteImageIfExists($imageName){
        if($imageName){
            $imagePath = 'uploads/images/' . $imageName;
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }
    public function deleteImage2IfExists($imageName){
        if($imageName){
            $imagePath = 'uploads/images2/' . $imageName;
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }

    public function deletePdfIfExists($pdfName){
        if($pdfName){
            $pdfPath = 'uploads/pdfs/' . $pdfName;
            if(file_exists($pdfPath)){
                unlink($pdfPath);
            }
        }
    }
    public function generateSlug($title, $modelClass){
        $slug = $this->str_slug($title);
        $count = 1;
        while($modelClass::where('slug', $slug)->exists()){
            $slug = $this->str_slug($title) . '-' . $count;
            $count++;
        }
        
        return $slug;  
    }
    

    public function str_slug($title, $seprator = '-'){
        $title = preg_replace('/[^\x20-\x7E]/u', '', $title);
        $title = strtolower($title);
        $title = preg_replace('/\s+/', $seprator, $title);
        return trim($title, $seprator);

    }
}