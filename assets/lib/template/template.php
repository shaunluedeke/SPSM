<?php

class template {

    private $template_folder = null;



    //Ordnerpfad angeben
    public function setTempFolder( $template_folder ) {
        $this->template_folder = $template_folder;
    }

    private $vars = array();
    private $l_delim = '{',
        $r_delim = '}';

    //Variable übergeben
    public function assign( $key, $value ) {
        if ( is_array( $value ) ) {
            if(!isset($this->vars[$key])) {
                $this->vars[$key] = array();
                array_push($this->vars[$key], $value);
            } else {
                array_push($this->vars[$key], $value);
            }
            return;
        }
        $this->vars[$key] = $value;
    }


    //abrufen
    public function parse( $template_file = null) {
        //Prüfen existiert ordnerpfad
        if($this->template_folder != null) {
            $template_file = $this->template_folder.$template_file;
        }
        //Prüfen existiert file
        if ( !file_exists( $template_file ) ) {
            exit( '<h1>$template_file</h1><h1>Template error</h1>' );
        }
        $content = file_get_contents($template_file);

        foreach ( $this->vars as $key => $value ) {
            $content = $this->parseContent( $key, $value, $content );
        }

        eval( '?> ' . $content . '<?php ' );
    }

    private function parseContent( $key, $value, $content ) {

        if ( is_array( $value ) ) { // ist ein Array (Loop schleife)
            $content = $this->parseLoop($key, $value, $content);
        } else if(is_bool ( $value ) ) { // ist ein Boolean (Abfrage)
            $content = $this->parseIf($key, $value, $content);
            $content = $this->parseIfNot($key, $value, $content);
        } else { // rest (Varriable)
            $content = $this->parseSingle($key, (string) $value, $content, null);
        }
        return $content;
    }

    private function parseLoop( $key, $value, $content ) {
        $match = $this->matchLoop($content, $key);
        if( $match == false ) return $content;
        $str='';
        foreach ( $value as $index ) {
            $cmatch=$match['1'];

            foreach ( $index as $k_row => $row ) {
                $cmatch = $this->parseContent( $key."_".$k_row, $row, $cmatch);
            }
            $str .= $cmatch;
        }

        return str_replace($match['0'], $str, $content);
    }


    private function parseSingle( $key, $value, $string, $index ) {
        if ( isset( $index ) ) {
            $string = str_replace( $this->l_delim . '%index%' . $this->r_delim, $index, $string );
        }
        return str_replace( $this->l_delim . $key . $this->r_delim, $value, $string );
    }

    private function parseIf( $variable, $data, $string ) {

        $match = $this->matchIf($string, $variable);

        if( $match == false ) return $string;
        if($data) {
            return str_replace( $match['0'], $match['1'], $string);
        }

        return str_replace( $match['0'], null, $string);
    }
    private function parseIfNot( $variable, $data, $string ) {

        $match = $this->matchIfNot($string, $variable);

        if( $match == false ) return $string;
        if(!$data) {
            return str_replace( $match['0'], $match['1'], $string);
        }

        return str_replace( $match['0'], null, $string);
    }


    private function matchLoop( $string, $variable ) {
        if ( !preg_match("|" . preg_quote($this->l_delim) . 'loop ' . $variable . preg_quote($this->r_delim) . "(.+?)". preg_quote($this->l_delim) . 'endloop '  . $variable . preg_quote($this->r_delim) . "|s", $string, $match ) ) {
            return false;
        }

        return $match;
    }
    private function matchIf( $string, $variable ) {
        if ( !preg_match("|" . preg_quote($this->l_delim) . 'if ' . $variable . preg_quote($this->r_delim) . "(.+?)". preg_quote($this->l_delim) . 'endif '  . $variable . preg_quote($this->r_delim) . "|s", $string, $match ) ) {
            return false;
        }

        return $match;
    }
    private function matchIfNot( $string, $variable ) {
        if ( !preg_match("|" . preg_quote($this->l_delim) . 'if not ' . $variable . preg_quote($this->r_delim) . "(.+?)". preg_quote($this->l_delim) . 'endif not '  . $variable . preg_quote($this->r_delim) . "|s", $string, $match ) ) {
            return false;
        }

        return $match;
    }
}
?>