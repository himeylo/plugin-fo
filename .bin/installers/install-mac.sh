#!/bin/bash
# Install Docker, Node Version Manager, NodeJS, and Visual Studio Code for Mac OS.
# You must have administrative rights on your computer to run this script.

if [ "$(whoami)" != "root" ]; then
    SUDO=sudo
fi

NVM_VERSION="0.39.5"
NODE_VERSION="18"

# Install NVM.
if ! command -v nvm &> /dev/null
then
    curl -o- "https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh" | bash
fi

# Install Node using NVM.
if ! command -v node &> /dev/null
then
    if ! command -v nvm &> /dev/null
    then
        echo "NVM is not yet available in your path. Please close your terminal and re-run this script so NodeJS can be installed using NVM."
        exit 1
    fi
    nvm install ${NODE_VERSION}
    nvm use ${NODE_VERSION}
    nvm alias default ${NODE_VERSION}
    echo "Node v${NODE_VERSION} installed."
fi

echo "Installation finished. You may now use node, nvm, php, composer, and docker from your terminal. Examples: node -v, nvm -v"
echo "Possible next steps:"
echo "- Add your laptop's SSH key to your GitHub account."
