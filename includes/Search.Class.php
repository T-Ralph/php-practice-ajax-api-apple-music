<?php
    //Define Class
    Class Search {
        //Define Property
        public $keywords;

        //Define constructor
        public function __construct($keywords = "") {
            //Assign Property
            $this->keywords = $keywords;

            //Create Empty Object
            $this->json_data = json_decode("[]");

            //Check for Search Keywords
            if (!empty($keywords)) {
                $this->SearchKeywords();
            }
        }

        public function RenderSearchResults() {
            //Loop Through Search Results
            if ($this->json_data) :
                foreach ($this->json_data->results as $json_data) :
                    if ($json_data->kind && $json_data->kind == "song") :
                    ?>
                        <section class="search-results">
                            <h2><?php echo (!empty($json_data->artistName)) ? $json_data->artistName : ""; ?></h2>
                            <img src="<?php echo (!empty($json_data->artworkUrl100)) ? $json_data->artworkUrl100 : ""; ?>" />
                            <audio controls="">
                                <source src="<?php echo (!empty($json_data->previewUrl)) ? $json_data->previewUrl : ""; ?>" type="audio/mpeg">
                            </audio>
                            <p>
                                <span><strong><?php echo (!empty($json_data->trackName)) ? $json_data->trackName : ""; ?></strong></span>
                                <span><strong><?php echo (!empty($json_data->trackPrice)) ? $json_data->trackPrice : "" . ' ' . (!empty($json_data->currency)) ? $json_data->currency : ""; ?></strong></span>
                                <span><strong><?php echo (!empty($json_data->collectionName)) ? $json_data->collectionName : ""; ?></strong></span>
                                <span><strong><?php echo (!empty($json_data->country)) ? $json_data->country : ""; ?></strong></span>
                                <span><a href="<?php echo (!empty($json_data->trackViewUrl)) ? $json_data->trackViewUrl : ""; ?>" target="_blank">Listen on Apple Music</a></span>
                            </p>
                        </section>
                    <?php
                    endif;
                endforeach;
            endif;
        }

        public function RenderJSONResults() {
            //Create Array
            $data = array();
            $data["results"] = array();

            //Loop Through Search Results
            if ($this->json_data) :
                foreach ($this->json_data->results as $json_data) :
                    if ($json_data->kind && $json_data->kind == "song") :
                        $build_array = array();
                        $build_array["kind"] = "song";
                        $build_array["artistName"] = (!empty($json_data->artistName)) ? $json_data->artistName : NULL;
                        $build_array["artworkUrl100"] = (!empty($json_data->artworkUrl100)) ? $json_data->artworkUrl100 : NULL;
                        $build_array["previewUrl"] = (!empty($json_data->previewUrl)) ? $json_data->previewUrl : NULL;
                        $build_array["trackName"] = (!empty($json_data->trackName)) ? $json_data->trackName : NULL;
                        $build_array["trackPrice"] = (!empty($json_data->trackPrice)) ? $json_data->trackPrice : NULL;
                        $build_array["currency"] = (!empty($json_data->currency)) ? $json_data->currency : NULL;
                        $build_array["collectionName"] = (!empty($json_data->collectionName)) ? $json_data->collectionName : NULL;
                        $build_array["country"] = (!empty($json_data->country)) ? $json_data->country : NULL;
                        $build_array["trackViewUrl"] = (!empty($json_data->trackViewUrl)) ? $json_data->trackViewUrl : NULL;
                        array_push($data["results"], $build_array);
                    endif;
                endforeach;
            endif;

            //Convert Array to JSON and Echo
            echo json_encode($data);
        }

        public function SearchKeywords() {
            //Prepare & Search API
            $this->keywords = str_ireplace(" ", "+", $this->keywords);
            $this->json_api = 'https://itunes.apple.com/search?term=' . $this->keywords;
            $this->json_results = file_get_contents($this->json_api);
            $this->json_data = json_decode($this->json_results);
        }
    }
?>