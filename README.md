# Sabiha Airport Wifi Auto Connector (SAW-Internet-Auto-Connector)

This is a simple PHP script that automates the process of connecting to the Sabiha Gökçen Airport's wifi network. It interacts with the Wispotter network service by sending GET and POST requests, managing cookies, and performing login/authentication tasks.

## Features

- Sends multiple HTTP GET and POST requests to interact with the wifi network.
- Extracts hidden tokens from the response for authentication purposes.
- Continuously attempts to connect with the wifi network every 20 seconds.

## Requirements

- PHP 7.0 or higher
- cURL PHP extension
- Bash shell (for running the Bash script)

## Setup

1. Clone this repository:

   ```bash
   git clone https://github.com/BaseMax/SAW-Internet-Auto-Connector.git
   cd SAW-Internet-Auto-Connector
   ```

Make the Bash script executable:

  ```bash
  chmod +x run_script.sh
  ```
Ensure your PHP installation has cURL enabled. You can check this by running:

```bash
php -m | grep curl
```

Run the script:

```bash
./run_script.sh
```

This will start the infinite loop, running the connect.php script every 20 seconds.

### License

MIT License

Copyright (c) 2024, Max Base
