#!/bin/bash
# Install PHP, Composer, and NodeJS within a Linux environment.

if [ "$(whoami)" != "root" ]; then
    SUDO=sudo
fi

NODE_VERSION="18"

if ! command -v curl &> /dev/null
then
    ${SUDO} apt-get update
    ${SUDO} apt-get -y install curl
fi

INSTALL_NODE=false
if ! command -v node &> /dev/null
then
    INSTALL_NODE=true
else
    NODE_VERSION_INSTALLED=`node -v | cut -d "v" -f 2 | cut -d "." -f 1,2`
    if [ "$NODE_VERSION_INSTALLED" != "$NODE_VERSION" ]; then
        INSTALL_NODE=true
    fi
fi

if [ "$INSTALL_NODE" = true ]; then
    ${SUDO} apt-get update
    ${SUDO} apt-get install -y ca-certificates gnupg
    ${SUDO} mkdir -p /etc/apt/keyrings
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | ${SUDO} gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" | sudo tee /etc/apt/sources.list.d/nodesource.list
    ${SUDO} apt-get update
    ${SUDO} apt-get install nodejs -y
    echo "Latest version of NodeJS v${NODE_VERSION} installed."
fi

echo "Installation finished. You may now use node from your terminal. Examples: node -v"
