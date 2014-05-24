<?php

Form::macro('link', function($btnText, $route, $btnAttributes = array(), $anchorAttributes = array(), $btnType = 'button') {
    $type = array('type' => $btnType);
    $btnAttributes = array_merge($btnAttributes, $type);
    $href  = URL::to($route);
    $action = Route::currentRouteName();
    if ( isset($action['as']) ) {
        $href  = URL::to_route($route);
    }
    $output = '<a href="'. $href .'"';
    if (!empty($anchorAttributes)) {
        foreach ($anchorAttributes as $key => $value) {
            $output .= " $key=\"{$value}\"";
        }
    }
    $output .= '>'. Form::button($btnText, $btnAttributes) .'</a>';

    return $output;
});

Form::macro('errors', function($errors)
{
    $output = '';
    if (count($errors) > 0) {
        $output .= '<ul class="alert alert-danger list-unstyled">';
        foreach ($errors as $error) {
            $output .= '<li>'.$error.'</li>';
        }
        $output .= '</ul>';
    }

    return $output;
});

Form::macro('error', function($error)
{
    $output = '';
    if (!empty($error)) {
        $output .= '<div class="alert alert-danger list-unstyled">';
        $output .= $error;
        $output .= '</div>';
    }

    return $output;
});

Form::macro('preview', function($image, $path) {
    $output = "";
    if ($image) {
        $output .= '<img src="'.URL::asset($path.$image->name).'" class="img-form"></img>';
    }

    return $output;
});

Form::macro('multipleSelectEdit', function ($name, $list = array(), $selected = null, $optionSelected = null, $id = null, $options = array())
{
    if (!$id) {
        $selected = $optionSelected;
    }

    return Form::select($name, $list, $selected, $options);
});