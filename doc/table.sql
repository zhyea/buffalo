create table if not exists bu_meta
(
    id     int not null auto_increment primary key,

    parent int not null default 0,

    name   varchar(64),
    slug   varchar(32),
    remark varchar(128),

    sn     int          default 0

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

insert into bu_meta (name)
values ('语文'),
       ('数学'),
       ('外语'),
       ('历史');