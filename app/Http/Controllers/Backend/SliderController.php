<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    //
    public function viewSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.view_slider', compact('sliders'));
    }

    public function editSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.edit_slider', compact('sliders'));
    }

    public function sliderUpdate(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('slider_img')) {
            unlink($old_img);
            $img = $request->file('slider_img');
            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(1000, 370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'short_description' => $request->description,
                'description' => $request->description,
                'slider_img' => $save_url,
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('admin.viewSlider')->with($notification);
        } else {

            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'short_description' => $request->description,
                'description' => $request->description,
            ]);
            $notification = array(
                'message' => 'Slider Updated Without Image Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('admin.viewSlider')->with($notification);
        }

    }

    public function storeSlider(Request $request)
    {
        $request->validate([

            'slider_img' => 'required',
        ], [
            'slider_img.required' => 'Plz Select One Image',

        ]);
        $img = $request->file('slider_img');
        $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalName();
        Image::make($img)->resize(1000, 370)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'short_description' => $request->description,
            'description' => $request->description,
            'slider_img' => $save_url,
        ]);
        $notification = array(
            'message' => 'Slider Store Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('admin.viewSlider')->with($notification);
    }

    public function sliderInactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function sliderActive($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Slider Active Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function sliderDelete($id)
    {
        $slider= Slider::findOrFail($id);
        $img = $slider-> slider_img;
        unlink($img);
        Slider::findOrFail($id) -> delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }

}
