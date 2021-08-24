CREATE DATABASE students_course;


CREATE TABLE `m_course_info` (
 `id` int(12) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `details` text NOT NULL,
 `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `updated_on` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8


CREATE TABLE `m_students_info` (
 `id` int(12) NOT NULL AUTO_INCREMENT,
 `firstname` varchar(255) NOT NULL,
 `lastname` varchar(255) NOT NULL,
 `dob` date NOT NULL,
 `contactnumber` int(10) NOT NULL,
 `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_on` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8


CREATE TABLE `t_students_course_info` (
 `id` int(12) NOT NULL AUTO_INCREMENT,
 `studentId` int(12) NOT NULL,
 `courseId` int(12) NOT NULL,
 `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `courseId` (`courseId`),
 KEY `studentId` (`studentId`),
 CONSTRAINT `t_students_course_info_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `m_course_info` (`id`),
 CONSTRAINT `t_students_course_info_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `m_students_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8