CREATE TABLE `guestbook` (
  `post_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`post_id`,`email`),
  ADD KEY `datetime` (`datetime`);