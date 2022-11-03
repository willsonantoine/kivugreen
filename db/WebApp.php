<?php {

    include './db/declare.php';
    include './db/http.php';
    include './db/cls.php';
}


class WebApp extends cls
{
    public   $Textes =  [];
    public   $Images = [];
    public   $Blog =  [];
    public   $Event =  [];
    public   $Video =  [];
    public   $Document =  [];
    public   $config =  [];
    public   $all =  [];
    public   $Profils =  [];
    public   $Pages = array();

    public $current_title = null;
    public $current_extrait = null;
    public $current_containt = null;
    public $current_image = null;
    public $current_url = null;
    public $current_date = null;
    public $current_user = null;
    public $current_favorit =0;


    public  $data =  [];

    public function __construct($page = 'home', $title = null, $search = null, $current_page = null, $url_page = '404.php')
    {
        $response = $this->getHttpData(
            '/web-manage/containt',
            [
                "page" => $page,
                "title" => $title,
                "search" => $search,
                'POST'
            ]
        );

        if ($response->status == 200) {

            $this->data = $response->data;
            $this->all = $response->data->all;

            $this->Blog = $response->data->blog;
            $this->Profils = $response->data->profil;

            $this->getPages();
            $this->setConfig();
            $this->getCurrentBlog($title);

            include URL_FILE_WEB . $url_page . '.php';

        } else {

            include URL_FILE_WEB . '404.php';

        }
    }

    public function getCurrentBlog($title)
    {
        foreach ($this->Blog as $key => $value) {

            if ($value->title == $title) {

                $this->current_title = $value->title;
                $this->current_extrait = $value->extrait;
                $this->current_containt = $value->containt;
                $this->current_image = $this->getImgItem($value)[0];
                $this->current_url = $value->url;
                $this->current_date = $value->createAt;
                $this->current_user = $value->username;
                $this->current_favorit = $value->favorit; 

            }
        }
    }

    public function getPages()
    {

        foreach ($this->all as $key => $value) {

            if (!in_array($value->page, $this->Pages) && !in_array($value->page, ['blog', 'Blog', 'Home', "Acceuil", "Galerie", "Apropos"])) {
                $this->Pages[] = $value->page;
            }
        }
    }

    /**
     * Get the value of Textes
     */
    public function getTextes()
    {
        return $this->Textes;
    }

    /**
     * Set the value of Textes
     *
     * @return  array The value of Textes
     */
    public function setTextes($texte = 'Texte')
    {
        $this->Textes = array_filter($this->data, function ($k) {
            return $k == 'Text';
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Get the value of Images
     */
    public function getImages()
    {
        return $this->Images;
    }

    /**
     * Set the value of Images
     *
     * @return  array The value of Images
     */
    public function setImages($Images)
    {
        $this->Images = $Images;

        return $this;
    }

    /**
     * Get the value of Blog
     */
    public function getBlog()
    {
        return $this->Blog;
    }

    /**
     * Set the value of Blog
     *
     * @return  array
     */
    public function setBlog($Blog)
    {
        $this->Blog = $Blog;

        return $this;
    }

    /**
     * Get the value of Event
     */
    public function getEvent()
    {
        return $this->Event;
    }

    /**
     * Set the value of Event
     *
     * @return  array
     */
    public function setEvent($Event)
    {
        $this->Event = $Event;

        return $this;
    }

    /**
     * Get the value of Video
     */
    public function getVideo()
    {
        return $this->Video;
    }

    /**
     * Set the value of Video
     *
     * @return  array
     */
    public function setVideo($Video)
    {
        $this->Video = $Video;

        return $this;
    }

    /**
     * Get the value of Document
     */
    public function getDocument()
    {
        return $this->Document;
    }

    /**
     * Set the value of Document
     *
     * @return  array
     */
    public function setDocument($Document)
    {
        $this->Document = $Document;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  array
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of config
     */
    public function getConfig()
    {
        return $this->config;
    }
    /**
     * Get the value of config
     */
    public function getConfigValue($value, $isImage = false)
    {

        return  $this->getVal($this->config, $value, $isImage);
    }

    /**
     * Get the value of All Text Properties
     */
    public function getText($ref_object)
    {

        $result = [];

        $result = $this->getItem($this->all, $ref_object);

        return  $result;
    }
    /**
     * Get the value of All Images Properties
     */
    public function getImage($ref_object)
    {

        $result = [];

        $result = $this->getItem($this->all, $ref_object);


        return  $this->getImgItem($result);
    }

    /**
     * Set the value of config
     *
     * @return  self
     */

    public function setConfig($config = 'null')
    {
        $this->config =  $this->data->config;
    }
}
