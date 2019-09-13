<?php
$locale_jsons = glob("locale/locale-*.json");
$locale_set = json_decode(file_get_contents(__DIR__ . "/locale.json"));
$default_locale = $locale_set->default;
$default_locale_path = "locale/locale-$default_locale.json";

$loc;
$page_key;

function setPageLocale($locale) {
    global $default_locale_path;
    global $loc;

    $locale_path = "locale/locale-$locale.json";
    if (file_exists($locale_path)) {
        $loc = json_decode(file_get_contents(__DIR__ . "/" . $locale_path), true);
    } else {
        $loc = json_decode(file_get_contents(__DIR__ . "/" . $default_locale_path), true);
    }
}

function lc() {
    global $loc;
    global $page_key;

    $args = func_get_args();
    $key = $args[0];
    $value = isset($loc[$page_key][$key]) ? $loc[$page_key][$key] : "none";

    if (strncasecmp($value, ":>>>", 4) === 0)
    /*if (strpos($value, ':>>>') !== false)*/
     {
        $procv = str_replace(":>>>", "", $value);
        $parts = explode(".", $procv);
        if (isset($loc[$parts[0]][$parts[1]]))
            $value = $loc[$parts[0]][$parts[1]];
        else
            $value = "none"; //(isset($value) ? $value : "none");
    }
    else if (strncasecmp($key, ".", 1) === 0) {
        $procv = substr($key, 1);
        $parts = explode(".", $procv);
        if (isset($loc[$parts[0]][$parts[1]]))
            $value = $loc[$parts[0]][$parts[1]];
        else
            $value = "none";
    }

    if (count($args) > 1) {
        $variables = array();

        for ($i = 1; $i < count($args); $i++) {
            array_push($variables, $args[$i]);
        }
        $value = vsprintf($value, $variables);
    }

    echo $value;
}

function setDefaultPage($page) {
    global $page_key;
    $page_key = $page;
}

function changeDefaultLocale($locale) {
    global $locale_set;
    $locale_set->default = $locale;
    file_put_contents(__DIR__ . "/locale.json", json_encode($locale_set));
    setPageLocale($locale);
}

function handleLocaleChange($page_link) {
    if (isset($_GET['locale'])) {
        $loc = $_GET['locale'];
        changeDefaultLocale($loc);
        header("Location: $page_link");
        exit();
    }
}

setPageLocale($default_locale_path);
setDefaultPage("index");
?>