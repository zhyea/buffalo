--
-- meta data
create table if not exists bu_meta
(
    id     int not null auto_increment primary key,

    parent int not null default 0,

    type   varchar(16),
    name   varchar(64),
    slug   varchar(32),
    remark varchar(128),

    sn     int          default 0

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

insert into bu_meta (type, name)
values ('category', '语文'),
       ('category', '数学'),
       ('category', '外语'),
       ('category', '历史');

insert into bu_meta (parent, type, name)
values (4, 'category', '东方历史'),
       (4, 'category', '西方历史');


-- settings table
create table if not exists bu_settings
(
    id    int not null auto_increment primary key,

    name  varchar(64),
    value varchar(128)

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

insert into bu_settings (name, value)
values ('site_name', 'Buffalo');

-- media
create table if not exists bu_media
(
    id       int not null auto_increment primary key,

    type     varchar(16),
    name     varchar(32),
    position varchar(128)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- authors
create table if not exists bu_author
(
    id    int not null auto_increment primary key,

    name  varchar(64),
    value varchar(128)

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- works
create table if not exists bu_works
(
    id          int not null auto_increment primary key,

    author_id   int,
    category_id int,
    pic_id      int,

    name        varchar(64),
    value       varchar(128)

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

