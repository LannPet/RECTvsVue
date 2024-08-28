<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary models, libraries, etc.
    }

    public function add_item() {
        // Enable CORS if needed (Optional)
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');

        // Check if the request method is POST
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Get the raw POST data directly since it's being sent as plain text
            $item = file_get_contents("php://input");

            // Validate the input to make sure it's not empty
            if (!empty($item)) {
                $item = htmlspecialchars($item); // Sanitize the input to prevent XSS

                // Simulate adding the item to a list (or processing the data)
                // Since there's no database, we'll just create a response
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