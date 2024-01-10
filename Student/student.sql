CREATE DATABASE student;

USE student;

DROP TABLE `student`;
CREATE TABLE if not exists `student`(
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL ,
    email varchar(250) NOT NULL ,
    PRIMARY KEY (id)
) ENGINE =InnoDB DEFAULT  CHARSET = latin1 AUTO_INCREMENT=2;
INSERT INTO `student` VALUES (1, 'Ngo Truong Xuan', 'xuannt121297@gmail.com');
INSERT INTO `student` VALUES (2, 'Ngo Xuan Truong', 'truongnx130296@gmail.com');
INSERT INTO `student` VALUES (3, 'Nguyen Thi Hai', 'haint280897@gmail.com');