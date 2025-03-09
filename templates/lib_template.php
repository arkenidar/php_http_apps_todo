<?php
function apply_template($template_file, $template_variables = [], $path_prefix = null)
{
    // template variables
    global $wrap, $_, $_u, $_e, $_wrap_with, $_get_wrapped_content;

    // if path_prefix is not set, use auto path prefix
    if ($path_prefix == null) // auto path prefix
        $template_file = dirname(__FILE__) . '/../templates/' . $template_file . '.php';

    // get variable & escape it
    $_ = function ($variable_name) use (&$template_variables) {
        return htmlspecialchars($template_variables[$variable_name]);
    }; // get variable & escape it

    // get variable & don't escape it
    $_u = function ($variable_name) use (&$template_variables) {
        return $template_variables[$variable_name];
    }; // get variable & don't escape it (left Unescaped)

    // escape something
    $_e = function ($value_to_escape) {
        return htmlspecialchars($value_to_escape);
    }; // escape something

    // wrap with another template
    $_wrap_with = function ($wrapped_with) {
        global $wrap;
        if (isset($wrap) == false) $wrap = [];
        $wrap[] = $wrapped_with;
    };

    // get wrapped content
    $_get_wrapped_content = function () {
        global $_u;
        $wrapped_content = $_u('wrapped_content');
        return array_pop($wrapped_content);
    };

    // produce template
    ob_start(); // start output buffering
    // include template file
    require $template_file;
    // get produced template
    $produced_template = ob_get_contents(); // get output buffer content
    ob_end_clean(); // end output buffering

    // wrap with another template
    if (isset($wrap) && count($wrap) > 0) { // wrapper template

        // if wrapped_content is not set, create it
        if (isset($template_variables['wrapped_content']) == false)
            $template_variables['wrapped_content'] = [];

        // add current template to wrapped_content
        $template_variables['wrapped_content'][] = $produced_template;

        // apply wrapper template
        $produced_template = apply_template(array_pop($wrap), $template_variables);
    }

    // return produced template
    return $produced_template;
}
