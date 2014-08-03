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

        $imagePath = 'public/uploads/';
        $thumbPath = 'public/uploads/thumbs/';

        $origFilename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimetype = $file->getMimeType();

        if (!in_array($extension, $this->whitelist)) {
            return Response::json('Supported extensions: jpg, jpeg, gif, png', 400);
        }

        if (!in_array($mimetype, $this->mimeWhitelist) || $validator->fails()) {
            return Response::json('Error: this is not an image', 400);
        }

        $filename = str_random(12).'.'.$extension;

        $image = ImageKit::make($file);

        //save the original sized image for displaying when clicked on
        $image->save($imagePath.$filename);

        // make the thumbnail for displaying on the page
        $image->fit(640, 480)->save($thumbPath.'thumb-'.$filename);

        if ($image) {
            $dbimage = new Image();
            $dbimage->thumbnail = 'uploads/thumbs/thumb-'.$filename;
            $dbimage->image = 'uploads/'.$filename;
            $dbimage->original_filename = $origFilename;
            $dbimage->save();
            return $dbimage;
        } else {
            return Response::json('error', 400);
        }
    }
}
