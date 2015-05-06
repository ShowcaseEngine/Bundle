<?php namespace Bundle\Framework;

class Bundle {
	protected $file;
	protected $values = array();

	public function __construct($file) {
        $this->file = './views/'.$file.'.view.bundle';
    }

    public function set($key, $value) {
    	$this->values[$key] = $value;
    }

    public function content() {
    	if (!file_exists($this->file)) {
    		return "That view doesn't exist.";
    	}
    	$output = file_get_contents($this->file);

    	foreach ($this->values as $key => $value) {
    		$tagToReplace = "@$key";
    		$output = str_replace($tagToReplace, $value, $output);
    	}

    	return $output;
    }

    public function render() {
    	if (!file_exists($this->file)) {
    		echo "That view doesn't exist.";
    	}
    	$output = file_get_contents($this->file);

    	foreach ($this->values as $key => $value) {
    		$tagToReplace = "@$key";
    		$output = str_replace($tagToReplace, $value, $output);
    	}

    	echo $output;
    }

    public static function extend($templates, $seperator = "n") {
    	$output = "";

    	foreach ($templates as $template) {
    		$content = (get_class($template) !== "Template")
    			? "Error, incorrect type - expected Template."
    			: $template->output();
    		$output .= $content . $seperator;
    	}

    	return $output;
    }
}
