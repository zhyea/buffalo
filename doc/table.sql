--
-- user table
create table if not exists bu_user
(
    id       int                not null auto_increment primary key,

    username varchar(32) unique not null,
    email    varchar(64) unique not null,
    password varchar(64),
    nickname varchar(32)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

insert into bu_user (username, email, password, nickname)
values ('admin', 'admin@chobit.org', '81b1c925de908ce13eaf44c5b9bbe6f0', 'long');


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

insert into bu_meta (type, name, slug)
values ('category', '未分类', 'default');


-- settings table
create table if not exists bu_settings
(
    id    int         not null auto_increment primary key,

    name  varchar(64) not null unique,
    value varchar(128)

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

insert into bu_settings (name, value)
values ('site_name', 'Buffalo'),
       ('notice', '这里是通知信息，有时间可以翻阅一下');

-- media
create table if not exists bu_media
(
    id   int not null auto_increment primary key,

    type varchar(16),
    name varchar(32),
    path varchar(128)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- authors
create table if not exists bu_author
(
    id      int not null auto_increment primary key,

    name    varchar(64),
    country varchar(32) default 'unknown',
    bio     mediumtext

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- works
create table if not exists bu_work
(
    id          int not null auto_increment primary key,

    author_id   int,
    category_id int,
    cover       varchar(128),
    file        varchar(128),

    name        varchar(64),
    brief       tinytext

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- chapter
create table if not exists bu_chapter
(
    id        int not null auto_increment primary key,

    parent    int default 0,
    work_id   int,

    name      varchar(64),
    key_words varchar(64),
    content   mediumtext

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;


-- feature
create table if not exists bu_feature
(
    id        int not null auto_increment primary key,

    cover     varchar(128),

    name      varchar(64),
    key_words varchar(64),
    brief     tinytext

) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;

-- feature-work
create table if not exists bu_feature_record
(
    id         int not null auto_increment primary key,
    type       tinyint default 1,
    feature_id int,
    record_id  int
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4;