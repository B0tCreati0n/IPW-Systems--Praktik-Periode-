CREATE TABLE 'pollQustion' (
    'pollId' bigint NOT NULL,
    'pollQustion' text NOT NULL,
    'pollAnswer' bigint NOT NULL,
    'pollStatus' tinyint NOT NULL,
    'timeStamp' timeStamp NOT NULL DEFAULT unix_timestamp
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE 'pollQustion'
    ADD PRIMARY KEY ('pollId');
    ADD KEY ('timestamp');