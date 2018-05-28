create database messwall;
 
use discussion;

create table authors 
(
    author_id int unsigned not null auto_increment primary key,
    name tinytext not null,
    date_registration datetime not null DEFAULT CURRENT_TIMESTAMP,
    email tinytext
);

create table message_header
(
  parent_post_id int default 0 not null,
  author_id int unsigned not null,
  has_children int default 0 not null,
  posted datetime not null DEFAULT CURRENT_TIMESTAMP,
  post_id int unsigned not null auto_increment primary key
);
 
create table message_body
(
  post_id int unsigned not null primary key,
  message text
);

grant select, insert, update, delete
on messwall.*
to messwall@localhost identified by 'password';



/*new user*/
INSERT INTO `authors` (`author_id`, `name`, `date_registration`, `email`) VALUES (NULL, 'Николай', '2018-05-27 00:00:00', 'aaa@aaa,gg');

/*new messsage_header and message_text*/
INSERT INTO `message_header` (`parent_post_id`, `author_id`, `has_children`, `posted`, `post_id`) VALUES ('0', '1', '0', CURRENT_TIMESTAMP, '2');
INSERT INTO `message_body` (`post_id`, `post_text`) VALUES ('2', 'Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения Какой-то ещё текст сообщения ');
