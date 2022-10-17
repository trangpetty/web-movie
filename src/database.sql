CREATE TABLE movie(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    path VARCHAR(400) NOT NULL,
    image VARCHAR(400) NOT NULL,
    summary VARCHAR(500) NOT NULL
);
INSERT INTO movie(name, path, image, summary) VALUES

CREATE TABLE account (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    username NVARCHAR(50) NOT NULL,
    image VARCHAR(400) NOT NULL,
    role TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO account(email, password, username, image, role) VALUES
("nghiadk0123@gmail.com","Trang_2018011407", "Ngoc Nghia", "https://scontent.fsgn2-5.fna.fbcdn.net/v/t39.30808-1/309562167_2220899894737071_834915498811354596_n.jpg?stp=dst-jpg_p320x320&_nc_cat=104&ccb=1-7&_nc_sid=7206a8&_nc_ohc=4fP5UgQiqjkAX_FeM5M&_nc_ht=scontent.fsgn2-5.fna&oh=00_AT_6xXMWpsE5HMYsEbRsrhr_hWQJU8LLU1jWXZ2-SMGWsA&oe=634B5B36",0);
("trang200164@nuce.edu.vn","Nghia_26072001", "Le Thi Thuy Trang","https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/310713178_2220557024788107_5094334276638189307_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=aDB3uJxiN7kAX8R-Z_W&_nc_ht=scontent.fsgn2-6.fna&oh=00_AT_HBDVU9MbXKBvSw3CURsZhg8-mOM_qim8kDleYpFy_CQ&oe=6349466B",1),
("trangpetty22072001@gmail.com","Nghia_26072001", "Le Thi Thuy Trang", "https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/310713178_2220557024788107_5094334276638189307_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=aDB3uJxiN7kAX8R-Z_W&_nc_ht=scontent.fsgn2-6.fna&oh=00_AT_HBDVU9MbXKBvSw3CURsZhg8-mOM_qim8kDleYpFy_CQ&oe=6349466B",0);

CREATE TABLE comment (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username NVARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    image VARCHAR(400) NOT NULL,
    date DATETIME NOT NULL,
    comment NVARCHAR(100) NULL
);

INSERT INTO comment(username, email, image, comment) VALUES 
("Le Thi Thuy Trang","trangpetty22072001@gmail.com", "https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/310713178_2220557024788107_5094334276638189307_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=aDB3uJxiN7kAX8R-Z_W&_nc_ht=scontent.fsgn2-6.fna&oh=00_AT_HBDVU9MbXKBvSw3CURsZhg8-mOM_qim8kDleYpFy_CQ&oe=6349466B","The movie is great!!!");

