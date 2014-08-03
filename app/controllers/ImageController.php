<?php

use Intervention\Image\ImageManagerStatic as ImageKit;

class ImageController extends \BaseController {

    protected $whitelist = array('jpg', 'jpeg', 'png', 'gif');
    protected $mimeWhitelist = array('image/gif', 'image/jpeg', 'image/png');

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

        $input = array('image' => $file);
        $rules = array('image' => 'image');

        $validator = Validator::make($input, $rules);

        $destinationPath = 'public/uploads/';

        $origFilename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimetype = $file->getMimeType();

        if (!in_array($extension, $this->whitelist)) {
            return Response::json('Supported extensions: jpg, jpeg, gif, png', 400);
        }

        if (!in_array($mimetype, $this->mimeWhitelist)) {
            return Response::json('Error: this is not an image', 400);
        }

        if ($validator->fails()) {
            return Response::json('Error: Not an image');
        }

        $filename = str_random(12).'.'.$extension;

        $image = ImageKit::make($file)->fit(640, 480)->save($destinationPath.$filename);

        if ($image) {
            $dbimage = new Image();
            $dbimage->filename = 'uploads/'.$filename;
            $dbimage->title = $origFilename;
            $dbimage->save();
            return $dbimage;
        } else {
            return Response::json('error', 400);
        }
    }
}
