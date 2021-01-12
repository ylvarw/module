<?php

namespace Anax\Response;

/**
 * Handling a response.
 */
class Response
{
    /**
    * @var array  $headers    set all headers to send.
    * @var array  $statusCode set statuscode to use.
    * @var string $body       body to send with response.
    * @var string $filename   a filename to send for download.
    */
    private $headers = [];
    private $statusCode = null;
    private $body = null;
    private $filename = null;



    /**
     * Set status code to be sent as part of headers.
     *
     * @param int $value of response status code
     *
     * @return self
     */
    public function setStatusCode(int $value = null)
    {
        if (is_null($value)) {
            return $this;
        }

        $this->statusCode = $value;
        return $this;
    }



    /**
     * Get status code to be sent as part of headers.
     *
     * @return integer value as status code or null if not set.
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }



    /**
     * Set headers.
     *
     * @param string $header type of header to set
     *
     * @return self
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }



    /**
     * Get all headers.
     *
     * @return array with headers
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }



    /**
     * Send headers.
     *
     * @return self
     */
    public function sendHeaders()
    {
        if (php_sapi_name() !== "cli" && headers_sent($file, $line)) {
            throw new Exception("Try to send headers but headers already sent, output started at $file line $line.");
        }

        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            if (php_sapi_name() !== "cli") {
                header($header);
            }
        }

        return $this;
    }



    /**
     * Set the body.
     *
     * @param callable|string $body either a string or a callable that
     *                              can generate the body.
     *
     * @return self
     */
    public function setBody($body)
    {
        if (is_string($body)) {
            $this->body = $body;
        } elseif (is_array($body)) {
            $this->setJsonBody($body);
        } elseif (is_callable($body)) {
            ob_start();
            $res1 = call_user_func($body);
            $res2 = ob_get_contents();
            $this->body = $res2 . $res1;
            ob_end_clean();
        }
        return $this;
    }



    /**
     * Get the body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }



    /**
     * Send a file to be downloaded by the user.
     *
     * @param string $filename to the file to download.
     *
     * @return self
     */
    public function addFile(string $filename) : object
    {
        $this->filename = $filename;

        // Get file type and set it as Content Type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        header("Content-Type: " . finfo_file($finfo, $filename));
        finfo_close($finfo);

        // Use Content-Disposition: attachment to specify the filename
        $this->addHeader("Content-Disposition: attachment; filename="
            . basename($filename));

        // No cache
        $this->addHeader("Expires: 0");
        $this->addHeader("Cache-Control: must-revalidate");
        $this->addHeader("Pragma: public");

        // Define file size
        $this->addHeader("Content-Length: "
            . filesize($filename));

        return $this;
    }



    /**
     * Send a file to be downloaded by the user.
     *
     * @param string $filename to the file to download.
     *
     * @return self
     */
    public function sendFile() : object
    {
        ob_clean();
        flush();
        if ($this->filename && is_readable($this->filename)) {
            readfile($this->filename);
        }

        return $this;
    }



    /**
     * Send response supporting several ways of receiving response $data.
     *
     * @param mixed $data to use as optional base for creating response.
     *
     * @return self
     */
    public function send($data = null)
    {
        $statusCode = null;

        if ($data instanceof self) {
            return $data->send();
        }

        if (is_string($data)) {
            $this->setBody($data);
        }

        if (is_array($data) && isset($data[0])) {
            $this->setBody($data[0]);
        }

        if (is_array($data) && isset($data[1]) && is_numeric($data[1])) {
            $statusCode = $data[1];
        }

        $this->setStatusCode($statusCode);

        if (!headers_sent()) {
            $this->sendHeaders();
        }

        if ($this->body) {
            echo $this->getBody();
        }

        if ($this->filename) {
            $this->sendFile();
        }

        return $this;
    }



    /**
     * Send JSON response with an optional statuscode.
     *
     * @param mixed   $data       to be encoded as json.
     * @param integer $statusCode optional statuscode to send.
     *
     * @return self
     */
    public function sendJson($data, $statusCode = null)
    {
        return $this->setStatusCode($statusCode)
                    ->setJsonBody($data)
                    ->send();
    }



    /**
     * Set body with JSON data.
     *
     * @param mixed $data to be encoded as json.
     *
     * @return self
     */
    public function setJsonBody($data)
    {
        $this->addHeader("Content-Type: application/json; charset=utf8");
        $this->setBody(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return $this;
    }



    /**
     * Redirect to another page.
     *
     * @param string $url to redirect to
     *
     * @return self
     */
    public function redirect(string $url) : object
    {
        $this->addHeader("Location: " . $url);
        $this->body = null;
        return $this;
    }
}
