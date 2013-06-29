<?php
/**
 * This is a very simple class for return the HTML content of a web page via YQL
 * authors: ethan@bluetent.com and jeremy@bluetent.com
 */

class YqlScrape {
    
    public function __construct($base_url) {
        $this->base_url = $base_url;
    }
    
    public function get_base_url() {
        return $this->base_url;
    }
    
    public function set_base_url($url) {
        $this->base_url = $url;
    }
    
    /**
     * Prepare a query string for YQL
     */
    
    public function prepare($xpath, $url, $format) {
        return http_build_query(array(
                                    'q' => 'select * from html where xpath=\''.$xpath.'\' and url="'.$url.'"', 
                                    'format' => $format
                                 )
                               );
    }
    
    //Query YQL
    public function query($query_string) {
        return $this->get_contents( $this->base_url . $query_string );
    }
    
    //Provides a very basic alternative to file_get_contents which may not always be available
    private function get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
  
}
?>
