<?php

use Intervention\Image\ImageManagerStatic as ImageKit;

class ImageController extends \BaseController {

    public function all()
    {
        return Image::all();
    }

    public function getPage($page) {
        Paginator::setCurrentPage($page);

        return Image::paginate(9);
    }

    public function upload()
    {
        $file = Input::file('file');
        
        $destinationPath = 'public/uploads/';

        $realFilename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $filename = str_random(12).'.'.$extension;

        $image = ImageKit::make($file)->fit(640, 480)->save($destinationPath.$filename);

        if ($image) {
            $dbimage = new Image();
            $dbimage->filename = 'uploads/'.$filename;
            $dbimage->title = $realFilename;
            $dbimage->save();
            return $dbimage;
        } else {
            return Response::json('error', 400);
        }
    }
}
