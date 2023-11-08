CREATE TABLE `pollQustions` (
    `pollId` bigint(20) NOT NULL,
    `pollQustion` text NOT NULL,
    `pollAnswer` bigint NOT NULL,
    `pollAnswerVotes` bigint NOT NULL,
    `pollStatus` tinyint NOT NULL,
    `timeStamp` timeStamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `pollQustions`
    ADD PRIMARY KEY (`pollId`);
    ADD KEY `timeStamp` (`timeStamp`);