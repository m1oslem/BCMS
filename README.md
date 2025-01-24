# BCMS
Braches Camera Monitoring System


  sudo apt install -y docker.io
  sudo systemctl start docker
  sudo systemctl enable docker 
  mkdir -p ~/viseron/recordings
  mkdir -p ~/viseron/config


docker run -d --restart unless-stopped \
  -v ~/viseron/recordings:/recordings \
  -v ~/viseron/config:/config \
  -v /etc/localtime:/etc/localtime:ro \
  -p 80:8888 \
  --name viseron \
  roflcoopter/viseron:latest





CREATE DATABASE user_management;

USE user_management;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'user', 'employ', 'other') NOT NULL
);
