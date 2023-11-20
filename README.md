# WordPress Plugin

This plugin gets data from any API that is set in the plugin settings. The shortcode, `[fo-shortcode]` displays a content view from the top 4 returned API data results set, followed by a raw data dump for ease of reference.

Follow the guidance in Developer Installation to set up and run your local environment. The sections that follow contain additional information for your reference.

## Developer Installation

These instructions provide 2 options for running your local environment. You only need to use one option.

### Option 1. Docker

Run the commands below and then open your browser to [http://localhost:8888](http://localhost:8888).

```shell
git clone https://github.com/himeylo/plugin-fo
cd plugin-fo
npm install
npm start
```
Running `npm start` will start up your local environment and, also, begin watching for changes to styles/scripts.

### Option 2. Local

```shell
cd ~/Local Sites/your-site/app/public/wp-content/plugins
git clone https://github.com/himeylo/plugin-fo
cd plugin-fo
npm install
composer install
```

### Login Credentials
When prompted, use the following to log in to the WordPress dashboard:
```
admin
password
```



## Directory Structure

This plugin uses a specific directory structure which separates concerns between WordPress site administration features, WordPress site rendering hooks, static assets (CSS, JS, images, etc), and third party integrations. The directories are listed below with a brief description of what they contain.

1. **.bin** - Custom scripts for local development.
2. **.github** - GitHub integration files such as Actions workflows.
3. **.vscode** - Visual Studio Code integration files.
4. **.wp-env** - WordPress development environment default content.
5. **src** - Source code for the plugin.
   - Common WordPress feature implementations that you can copy and modify for your plugin.
   - **assets** - JavaScript, CSS, images, fonts, and other static files.
   - **views** - File content output to the browser by the plugin. This is where you should put most or all of the HTML output from your plugin, to make that content easier to find and change.
6. **index.php** - The entrypoint for the plugin's source code, which is loaded by WordPress if the plugin is activated for a site.

## Commands

The commands you will use the most frequently for developing a plugin with this repository are listed below.

For a complete list of commands, refer to [package.json](package.json) and [composer.json](composer.json).

| Command         | Description                                                           |
| --------------- | --------------------------------------------------------------------- |
| `npm install`   | Install your project dependencies for the first time.                 |
| `npm start`     | Start the development environment, build files, and watch for changes |
| `npm run build` | Build asset files at src/assets/css/\*.scss                           |
| `npm run stop`  | Stop the development environment                                      |

## System Requirements for Development

You will need the following tools installed on your computer:

- [Docker](https://www.docker.com/products/docker-desktop)
- [Node.js](https://nodejs.org/en/download/) or [NVM](https://github.com/nvm-sh/nvm)
- [git](https://git-scm.com/downloads)

To make this easier, you can use an installer included in this repository by saving it to your computer and making it executable.
You must have administrator rights to run these installers.

### Mac Installation

1. Copy this file to your computer: [.bin/installers/install-mac.sh](.bin/installers/install-mac.sh)
2. Open your terminal and navigate to the directory where you saved the file.
3. Make the file executable: `chmod +x install-mac.sh`
4. Run the file: `./install-mac.sh`

### Windows Installation

1. Copy this file to your computer: [.bin/installers/install-windows.bat](.bin/installers/install-windows.bat)
2. Open your terminal and navigate to the directory where you saved the file.
3. Run the file: `install-windows.bat`
