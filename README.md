# Ejemplo-de-blog-PHP
Ejemplo de blog PHP
Es importante crear la carpeta uploads que donde se guardaran los archivo img
****************************
Base de Datos Mysql blog_db
********************
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


![imagen](https://github.com/user-attachments/assets/31be7863-2dd1-4284-bdb6-787d540e42ea)


![imagen](https://github.com/user-attachments/assets/5f8211c5-09c7-46c5-a49c-ccd4c6f2eb43)


