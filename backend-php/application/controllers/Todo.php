<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Enable CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
    }

    public function add_item() {

        // Handle OPTIONS request for CORS preflight
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // Just return the headers and exit
            header("HTTP/1.1 200 OK");
            return;
        }

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            echo "<script>console.log('this is a REQUEST METHOD: " . $_SERVER['REQUEST_METHOD']. "' );</script>";
            // Get the raw POST data directly since it's being sent as plain text
            $item = file_get_contents("php://input");
            echo json_encode($item);
            // Validate the input to make sure it's not empty
            if (!empty($item)) {
                $item = htmlspecialchars($item); // Sanitize the input to prevent XSS

                // Send a JSON response back to the client
                echo json_encode([
                    'success' => true,
                    'message' => 'THIS MESSAGE IS FROM BACKEND PHP (CodeIgniter)',
                    'item' => $item
                ]);

            } else {
                // Send an error response if the input is empty
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid input. Please provide an item.'
                ]);
            }
        } else {
            // If the request method is not POST, return a 405 Method Not Allowed
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode([
                'success' => false,
                'message' => 'Only POST requests are allowed.'
            ]);
        }
    }
}