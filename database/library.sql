-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2026 at 05:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorID` int(11) NOT NULL,
  `AuthorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthorID`, `AuthorName`) VALUES
(1, 'Jack Canfield'),
(2, 'Mark Victor Hansen'),
(3, 'Lorraine Horsley'),
(4, 'Marina Le Ray'),
(5, 'Richard Johnson'),
(6, 'Helen Salter'),
(7, 'Phillip Burrows and Mark Foster'),
(8, 'Henry James'),
(9, 'Christine Lindop'),
(10, 'Retold by John Escott'),
(11, 'Erin Entrada Kelly'),
(12, 'Lois Lowry'),
(13, 'E.B.White'),
(14, 'Madeleine L\'Engle'),
(15, 'Jerry Spinell'),
(16, 'Janey Louise Jones'),
(17, 'Jonathan Emmett and Vanessa Cabban'),
(18, 'Jason Page and Adrian Reynolds'),
(19, 'Jill Murphy'),
(20, 'Julia Donaldson'),
(21, 'Laura Marsh'),
(22, 'Elizabeth Carney'),
(23, 'Anne Schreiber');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` int(11) NOT NULL,
  `BookTitle` varchar(255) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `NumberCopies` int(10) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `BookImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookTitle`, `CategoryID`, `NumberCopies`, `Genre`, `Description`, `BookImage`) VALUES
(1, 'Fun At The Fair: Read it yourself Level 1', 1, 1, 'Fiction', '\"Read it Yourself\" is a learning-to-read series of classic, traditional stories with four levels of difficulty to suit the stage your child is at with reading. Written in a simple way for young readers, they will build their confidence in learning to read as they progress through each level. Familiar fairytales and exciting stories will amuse children and encourage them to progress further with this series and become confident readers. Each book in \"The Read It Yourself With Ladybird Series\" is carefully structured to include many everyday words that are vital for first-reading/beginner readers.\r\nThey also contain clear, beautiful pictures for extra support and interest. Extra puzzle questions at the end of each book further help with comprehension. This \"Read It Yourself\" version of \"The Three Billy Goats Gruff\" is a level 1 title and so suitable for children who are beginning to learn to read. The story is told simply, using short sentences and a small number of frequently repeated words. Trust\r\n\'Ladybird\' to help your child learn to read and become a confident reader.', 'C1B1.jpg'),
(2, 'Cinderella: Read it yourself Level 1', 1, 0, 'Classic Story', '\"Read it Yourself\" is a learning-to-read series of classic, traditional stories with four levels of difficulty to suit the stage your child is at with reading. Written in a simple way for young readers, they will build their confidence in learning to read as they progress through each level. Familiar fairytales and exciting stories will amuse children and encourage them to progress further with this series and become confident readers. Each book in \"The Read It Yourself With Ladybird Series\" is carefully structured to include many everyday words that are vital for first-reading/beginner readers.\r\nThey also contain clear, beautiful pictures for extra support and interest. Extra puzzle questions at the end of each book further help with comprehension. This \"Read It Yourself\" version of \"The Three Billy Goats Gruff\" is a level 1 title and so suitable for children who are beginning to learn to read. The story is told simply, using short sentences and a small number of frequently repeated words. Trust\r\n\'Ladybird\' to help your child learn to read and become a confident reader.', 'C1B2.jpg'),
(3, 'The Three Billy Goats Gruff: Read it yourself Level 1', 1, 1, 'Folktale', '\"Read it Yourself\" is a learning-to-read series of classic, traditional stories with four levels of difficulty to suit the stage your child is at with reading. Written in a simple way for young readers, they will build their confidence in learning to read as they progress through each level. Familiar fairytales and exciting stories will amuse children and encourage them to progress further with this series and become confident readers. Each book in \"The Read It Yourself With Ladybird Series\" is carefully structured to include many everyday words that are vital for first-reading/beginner readers.\r\nThey also contain clear, beautiful pictures for extra support and interest. Extra puzzle questions at the end of each book further help with comprehension. This \"Read It Yourself\" version of \"The Three Billy Goats Gruff\" is a level 1 title and so suitable for children who are beginning to learn to read. The story is told simply, using short sentences and a small number of frequently repeated words. Trust\r\n\'Ladybird\' to help your child learn to read and become a confident reader.', 'C1B3.jpg'),
(4, 'Goldilocks And The Three Bears: Read it yourself Level 1', 1, 0, 'Classic Story', '\"Read it Yourself\" is a learning-to-read series of classic, traditional stories with four levels of difficulty to suit the stage your child is at with reading. Written in a simple way for young readers, they will build their confidence in learning to read as they progress through each level. Familiar fairytales and exciting stories will amuse children and encourage them to progress further with this series and become confident readers. Each book in \"The Read It Yourself With Ladybird Series\" is carefully structured to include many everyday words that are vital for first-reading/beginner readers.\r\nThey also contain clear, beautiful pictures for extra support and interest. Extra puzzle questions at the end of each book further help with comprehension. This \"Read It Yourself\" version of \"The Three Billy Goats Gruff\" is a level 1 title and so suitable for children who are beginning to learn to read. The story is told simply, using short sentences and a small number of frequently repeated words. Trust\r\n\'Ladybird\' to help your child learn to read and become a confident reader.', 'C1B4.jpg'),
(5, 'The Ugly Duckling: Read it yourself Level 1', 1, 1, 'Classic Story', '\"Read it Yourself\" is a learning-to-read series of classic, traditional stories with four levels of difficulty to suit the stage your child is at with reading. Written in a simple way for young readers, they will build their confidence in learning to read as they progress through each level. Familiar fairytales and exciting stories will amuse children and encourage them to progress further with this series and become confident readers. Each book in \"The Read It Yourself With Ladybird Series\" is carefully structured to include many everyday words that are vital for first-reading/beginner readers.\r\nThey also contain clear, beautiful pictures for extra support and interest. Extra puzzle questions at the end of each book further help with comprehension. This \"Read It Yourself\" version of \"The Three Billy Goats Gruff\" is a level 1 title and so suitable for children who are beginning to learn to read. The story is told simply, using short sentences and a small number of frequently repeated words. Trust\r\n\'Ladybird\' to help your child learn to read and become a confident reader.', 'C1B5.jpg'),
(6, 'Virtual Friends: Oxford Dominoes 2', 8, 1, 'Fiction', 'Reading age 12+\r\n68 pages\r\nDominoes 2. Virtual Friends\r\nViolet\'s mum moves to Paris, so she has to go too. Living in Paris should be very exciting, but Violet doesn\'t like it. Her only hope is to talk to her friends from London online.\r\nBut will that work? Will Violet ever enjoy Paris?\r\nAnd what can she do about her Mum?', 'C8B6.jpg'),
(7, 'Pirate Treasure: Oxford Bookworms Starter', 8, 1, 'Fiction', 'Reading age 10+\r\n40 pages\r\nOxford Bookworms Library: Pirate Treasure:\r\nStarter: 250-Word Vocabulary (Oxford\r\nBookworms Library: Thriller & Adventure)\r\nThis award-winning collection of adapted classic literature and original stories develops reading skills for low-beginning through advanced students.\r\nAccessible language and carefully controlled vocabulary build students\' reading confidence.\r\nIntroductions at the beginning of each story, illustrations throughout, and glossaries help build comprehension.\r\nBefore, during, and after reading activities included in the back of each book strengthen student comprehension.', 'C8B7.jpg'),
(8, 'The Turn of the Screw: Oxford Dominoes 2', 8, 1, 'Non-Fiction', 'Reading age 12+\r\n68 pages\r\nDominoes, New Edition: Level 2: 700-Word\r\nVocabulary The Turn of the Screw (Dominoes:\r\nLevel 2, 700 Headwords) by James Henry\r\n(2010-07-18) Paperback\r\nA young woman arrives at a large country house. Her job is to look after the two children who live there, but she soon discovers that there is something very strange about both the house and the children. The longer she stays, the more she feels that the two children are in danger - or is it that the children are the danger, and the person in danger is herself?', 'C8B8.jpg'),
(9, 'The Skateboarder: Oxford Dominoes Quick Starter', 8, 1, 'Non-fiction', 'Reading age 10+\r\n40 pages\r\nTHE SKATEBOARDER (Dominoes. Quick Starter)\r\nFour-level graded readers series, perfect for reading practice and language skills development at upper-primary and lower-secondary levels. Dominoes is a full-colour, interactive readers series that offers students a fun reading experience while building their language skills. With integrated activities, an interactive MultiROM, and exciting, fully dramatized audio for every story, the new edition of the series makes reading motivating for students while making it easy for you to develop their reading and language skills.', 'C8B9.jpg'),
(10, 'Willam Tell and Other Stories: Oxford Dominoes Starter', 8, 1, 'Non fiction, Modern Fiction', 'Reading age 10+\r\n56 pages\r\nWilliam Tell and Other Stories: Starter Level: 250-Word VocabularyWilliam Tell and Other Stories (Dominoes)\r\nThe activities in Dominoes keep students engaged in the stories and help to reinforce their understanding of the key language. They can be completed at home or in class. The project activities in Dominoes build on the themes from the story and encourage students to draw on their own experiences. Activities include note-taking and language tasks, leading to extended writing, poster-making, and class\r\npresentations. They are ideal for group work in class or individual assignments.', 'C8B10.jpg'),
(11, 'Hello, Universe', 14, 1, 'Novel, Young Adult Fiction', 'Reading age 8-12\r\n345 pages\r\nWinner of the Newbery Meda\r\n\"A charming, intriguingly plotted novel.\"—\r\nWashington Post\r\nNewbery Medalist Erin Entrada Kelly\'s Hello, Universe is a funny and poignant neighborhood story about unexpected friendships.\r\nTold from four intertwining points of view-two boys and two girls-the novel celebrates bravery, being different, and finding your inner bayani (hero). \"Readers will be instantly engrossed in this relatable neighborhood adventure and its eclectic cast of misfits.\" —\r\nBooklist. \r\nIn one day, four lives weave together in unexpected ways. Virgil Salinas is shy and kindhearted and feels out of place in his crazy-about-sports family. Valencia Somerset, who is deaf, is smart, brave, and secretly lonely, and she loves everything about nature. Kaori Tanaka is a self-proclaimed psychic, whose little sister, Gen, is always following her around. And Chet Bullens wishes the weird kids would just stop being so different so he can concentrate on basketball.\r\nThey aren\'t friends, at least not until Chet pulls a prank that traps Virgil and his pet guinea pig at the bottom of a well. This disaster leads Kaori, Gen, and Valencia on an epic quest to find missing Virgil. Through luck, smarts, bravery, and a little help from the universe, a rescue is performed, a bully is put in his place, and friendship blooms.\r\nThe acclaimed and award-winning author of Blackbird Fly and The Land of Forgotten Girls writes with an authentic, humorous, and irresistible tween voice that will appeal to fans of Thanhha Lai and Rita Williams-Garcia.\r\n\"Readers across the board will flock to this book that has something for nearly everyone-humor, bullying, self-acceptance, cross-generational relationships, and a smartly fateful ending.\" —\r\nSchool Library Journal', 'C14B11.jpg'),
(12, 'Number the Stars', 14, 1, 'Novel, Young Adult Fiction, Historical Fiction', 'Reading age 10-12\r\nGrade level 5 - 7\r\n132 pages\r\nAs the German troops begin their campaign to\r\n\"relocate\" all the Jews of Denmark, Annemarie Johansen\'s family takes in Annemarie\'s best friend, Ellen Rosen, and conceals her as part of the family.\r\nThrough the eyes of ten-year-old Annemarie, we watch as the Danish Resistance smuggles almost the entire Jewish population of Denmark, nearly seven thousand people, across the sea to Sweden. The heroism of an entire nation reminds us that there was pride and human decency in the world even during a time of terror and war.\r\nWith a new introduction by the author.', 'C14B12.jpg'),
(13, 'Charlotte\'s Web', 14, 1, 'Novel, Young Adult Fiction', 'Reading age 8-12\r\n272 pages\r\nPuffin Classics: the definitive collection of timeless stories, for every child.\r\nOn foggy mornings, Charlotte\'s web was truly a thing of beauty. Even Lurvy, who wasn\'t particularly interested in beauty, noticed the web when he came with the pig\'s breakfast. And then he took another look and he saw something that made him set his pail down. There, in the centre of the web, neatly woven in block letters, was a message. It said: SOME PIG!\r\nThis is the story of a little girl named Fern, who loves a little pig named Wilbur - and of Wilbur\'s dear friend, Charlotte, a beautiful large grey spider. When Fern\'s uncle decrees that Wilbur must become bacon, Fern, Charlotte, Templeton the rat and all Wilbur\'s farmyard friends come up with an ingenious plan to fool the humans, and save their very special pig.\r\nJoyful, funny, and deeply moving, Charlotte\'s Web is a story about the power of friendship, and celebrating what makes everyone special. It is rightly heralded as one of the greatest children\'s books ever written.\r\n\"E. B. White\'s writing is perfect... And Garth William\'s muted illustrations are entirely without fault. Whether read aloud or solo, this is a book well deserving of its \'classic\' status.\" - The Children\'s Book Review', 'C14B13.jpg'),
(14, 'A Wrinkle in Time', 14, 1, 'Science Fiction, Fantasy Fiction, Young Adult Fiction', 'Reading age 8-12\r\n245 pages\r\nPuffin Classics: the definitive collection of timeless stories, for every child.\r\nWe can\'t take any credit for our talents. It\'s how we use them that counts.\r\nWhen Charles and Meg Murry go searching through a \'wrinkle in time\' for their lost father, they find themselves on an evil planet where all life is enslaved by a huge pulsating brain known as \'It\'.\r\nMeg, Charles and their friend Calvin embark on a cosmic journey helped by the funny and mysterious trio of guardian angels, Mrs Whatsit, Mrs Who and Mrs Which. Together they must find the weapon that will defeat It.\r\nA groundbreaking and inspiring story of travel through time and space to battle a cosmic evil which has sold millions of copies and transformed children\'s literature. Winner of the Newbery Medal.', 'C14B14.jpg'),
(15, 'Maniac Magee', 14, 1, 'Novel, Young Adult Fiction', 'Reading age 10-13\r\n182 pages\r\nA Newbery Medal-winning modern classic about a racially divided small town and a boy who runs.\r\nJeffrey Lionel \"Maniac\" Magee might have lived a normal life if a freak accident hadn\'t made him an orphan. After living with his unhappy and uptight aunt and uncle for eight years, he decides to run--and not just run away, but run.\r\nThis is where the myth of Maniac Magee begins, as he changes the lives of a racially divided small town with his amazing and legendary feats.', 'C14B15.jpg'),
(21, 'Meerkats_National Geographic Kids (Level 1)', 3, 1, 'Non-fiction', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C3B21.jpg'),
(22, 'Koalas_National Geographic Kids (Level 1)', 3, 1, 'Non-Fiction', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C3B22.jpg'),
(23, 'Planets_National Geographic Kids (Level 1)', 3, 1, 'Non-fiction', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C3B23.jpg'),
(24, 'Sharks_National Geographic Kids (Level 2)', 3, 1, 'Non-fiction', 'Reading age 5 - 8 years:\r\n32 pages\r\nThis Level 2 text provides accessible information for animal-loving kids beginning to read independently, perfect to encourage the scientists and explorers of tomorrow!\r\nNational Geographic Readers\' combination of expert-vetted text, brilliant images, and a fun approach to reading have proved to be a winning formula with kids, parents, and educators.', 'C3B24.jpg'),
(25, 'Alligator And Crocodiles _ National Geographic Kids (Level 2)', 3, 1, 'Non-fiction', 'Reading age 5 - 8 years:\r\n32 pages\r\nThis Level 2 text provides accessible information for animal-loving kids beginning to read independently, perfect to encourage the scientists and explorers of tomorrow!\r\nNational Geographic Readers\' combination of expert-vetted text, brilliant images, and a fun approach to reading have proved to be a winning formula with kids, parents, and educators.', 'C3B25.jpg'),
(26, 'Chicken Soup for the Kid\'s Soul', 4, 2, 'Inspirational Stories & Motivational Essays', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C4B26.jpg'),
(27, 'Chicken Soup for the Preteen Soul', 4, 1, 'Inspirational Stories & Motivational Essays', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C4B27.jpg'),
(28, 'Chicken Soup for the Teenage Soul IV', 4, 2, 'Inspirational Stories & Motivational Essays', 'Reading age 3-5 years:\r\n32 pages\r\nThis level 1 reader is carefully leveled for an early independent reading or read aloud experience, perfect to encourage the scientists and explorers of tomorrow!\r\nLeveled readers are great for independent reading or for reading aloud; this set is ideal for kids who are just starting to learn how to read.\r\nEach book contains beautiful color photographs and exciting facts that will encourage young scientists to learn more about animals, nature, and inventions.', 'C4B28.jpg'),
(29, 'Chicken Soup for the Teenage Soul', 4, 2, 'Inspirational Stories & Motivational Essays', 'Reading age 5 - 8 years:\r\n32 pages\r\nThis Level 2 text provides accessible information for animal-loving kids beginning to read independently, perfect to encourage the scientists and explorers of tomorrow!\r\nNational Geographic Readers\' combination of expert-vetted text, brilliant images, and a fun approach to reading have proved to be a winning formula with kids, parents, and educators.', 'C4B29.jpg'),
(30, 'Chicken Soup for the Girls Soul', 4, 1, 'Inspirational Stories & Motivational Essays', 'Reading age 5 - 8 years:\r\n32 pages\r\nThis Level 2 text provides accessible information for animal-loving kids beginning to read independently, perfect to encourage the scientists and explorers of tomorrow!\r\nNational Geographic Readers\' combination of expert-vetted text, brilliant images, and a fun approach to reading have proved to be a winning formula with kids, parents, and educators.', 'C4B30.jpg'),
(51, 'The Owls Have Come To Take Us Away', 5, 1, 'Horror Fiction', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C5B31.jpg'),
(52, 'Where the Mountain Meets The Moon', 5, 1, 'Fairy Tale', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C5B32.jpg'),
(53, 'The Little Prince', 5, 1, 'Speculative Fiction', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C5B33.jpg'),
(54, 'Animal Farm', 5, 2, 'Dystopian Fiction', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C5B34.jpg'),
(55, 'Who Was Albert Einstein?: Biography', 6, 2, 'Biography', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C6B35.jpg'),
(56, 'Who Was Neil Armstrong?: Biography', 6, 3, 'Biography', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C6B36.jpg'),
(57, 'Who is Barrack Obama?: Biography', 6, 2, 'Biography', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C6B37.jpg'),
(58, 'who Was Charles Darwin?: Biography', 6, 2, 'Biography', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C6B38.jpg\n'),
(59, 'Avatar: The Last Airbender - The Rift Part 1', 11, 3, 'Graphic Novel', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C11B39.jpg'),
(60, 'Avatar: The Last Airbender - The Rift Part 2', 11, 3, 'Graphic Novel', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C11B40.jpg'),
(61, 'Avatar: The Last Airbender - The Rift Part 3', 11, 3, 'Graphic Novel', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C11B41.jpg'),
(62, 'Avatar: The Last Airbender: The Search', 11, 3, 'Graphic novel', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C11B42.jpg'),
(63, 'Henery VIII And His Six Wives', 12, 1, 'Historical Fiction', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C12B43.jpg'),
(64, 'The Usborne Book Of London', 12, 1, 'History', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C12B44.jpg'),
(65, 'The Romans - A History of Britain', 12, 1, 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imaginati', 'History', 'C12B45.jpg\r\n'),
(66, 'The Saxons And The Normans - A History of Britain', 12, 1, 'History', 'Reading age 10 - 12 years\r\n224 pages\r\nIn this delightfully creepy novel from Coretta Scott King/John Steptoe New Talent Award winner Ronald L. Smith, twelve-year-old Simon thinks he was abducted by aliens. But is it real, or just his over-active imagination? Perfect for fans of Mary Downing Hahn and Louis Sachar.\r\nTwelve-year-old Simon is obsessed with aliens.\r\nThe ones who take people and do experiments.\r\nWhen he\'s too worried about them to sleep, he listens to the owls hoot outside. Owls that have the same eyes as aliens-dark and foreboding.\r\nThen something strange happens on a camping trip, and Simon begins to suspect he\'s been abducted. But is it real, or just the overactive imagination of a kid who loves fantasy and role-playing games and is the target of bullies and his father\'s scorn?\r\nEven readers who don\'t believe in UFOs will relate to the universal kid feeling of not being taken seriously by adults that deepens this deliciously scary tale.', 'C12B46.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bookauthor`
--

CREATE TABLE `bookauthor` (
  `BookID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookauthor`
--

INSERT INTO `bookauthor` (`BookID`, `AuthorID`) VALUES
(26, 1),
(27, 1),
(30, 1),
(28, 2),
(29, 2),
(1, 3),
(2, 4),
(4, 4),
(3, 5),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(21, 21),
(22, 21),
(25, 21),
(23, 22),
(24, 23);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeyword`
--

CREATE TABLE `bookkeyword` (
  `BookID` int(11) NOT NULL,
  `KeywordID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_reservations`
--

CREATE TABLE `book_reservations` (
  `ReservationID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ReservationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` enum('reserved','cancelled','completed') NOT NULL DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_reservations`
--

INSERT INTO `book_reservations` (`ReservationID`, `BookID`, `UserID`, `ReservationDate`, `Status`) VALUES
(5, 2, 2, '2025-03-14 06:24:11', 'reserved'),
(13, 2, 15, '2025-04-09 21:17:27', 'completed'),
(15, 2, 26, '2025-04-10 16:49:56', 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Beginner: Easy Reader (Age 2-7)'),
(3, 'National Geographic Kids ( Age 3+)'),
(4, 'Chicken Soup for the Soul ( Age 8-18)'),
(5, 'Young Adult Fiction (Age 9-15)'),
(6, 'Biography (Age 6+)'),
(8, 'Oxford Bookworm Library (Age 12+)'),
(11, 'Graphic Novel: Comics (Age 10+)'),
(12, 'History (Age 8-14)'),
(14, 'Award Winning Novel (Age 10-16)');

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `KeywordID` int(11) NOT NULL,
  `KeywordName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Is_Read` tinyint(1) NOT NULL DEFAULT 0,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `Message`, `Is_Read`, `Created_At`) VALUES
(1, 15, 'New book available for rent!', 1, '2025-03-05 12:41:08'),
(2, 15, 'Your book request has been approved!', 1, '2025-03-05 15:52:53'),
(3, 15, 'New order received!', 1, '2025-03-05 21:14:13'),
(4, 15, 'Reminder: Meeting at 3 PM', 1, '2025-03-05 21:14:13'),
(5, 15, 'System update completed.', 1, '2025-03-05 21:14:13'),
(6, 1, 'Your membership has been approved! You can start borrowing books until 2025-03-28.', 0, '2025-03-14 03:38:39'),
(7, 2, 'Your membership has been approved! You can start borrowing books until 2025-03-28.', 0, '2025-03-14 04:25:01'),
(8, 19, 'Your membership has been approved! You can start borrowing books until 2025-03-28.', 0, '2025-03-14 06:21:55'),
(9, 22, 'Your membership has been approved! You can start borrowing books until 2025-04-17.', 0, '2025-04-03 18:05:54'),
(10, 20, 'Your membership has been approved! You can start borrowing books until 1970-01-01.', 0, '2025-04-03 19:38:54'),
(11, 20, 'Your membership has been approved! You can start borrowing books until 1970-01-01.', 0, '2025-04-03 19:50:55'),
(12, 20, 'Your membership has been approved! You can start borrowing books until 1970-01-01.', 0, '2025-04-03 20:18:31'),
(13, 20, 'Your membership has been approved! You can start borrowing books until 1970-01-01.', 1, '2025-04-03 20:22:44'),
(14, 20, 'Your membership has been approved! However, there was an issue with your membership end date. Please contact support.', 0, '2025-04-03 20:41:23'),
(15, 20, 'Your membership has been approved! You can start borrowing books until 2025-04-17.', 1, '2025-04-03 20:42:17'),
(16, 20, 'Your membership has been approved! You can start borrowing books until 2025-04-17.', 0, '2025-04-03 20:46:45'),
(17, 20, 'Your membership has been approved! You can start borrowing books until 1970-01-01.', 0, '2025-04-03 20:50:53'),
(18, 20, 'Your membership has been approved! You can start borrowing books until 2025-04-17.', 0, '2025-04-03 20:53:09'),
(19, 23, 'Your membership has been approved! You can start borrowing books until 2025-04-17.', 1, '2025-04-03 20:54:35'),
(20, 23, 'Your membership has been approved! You can start borrowing books until 2025-07-05.', 1, '2025-04-05 14:53:04'),
(21, 15, 'Your membership has been approved! You can start borrowing books until 2025-10-05.', 1, '2025-04-05 17:23:03'),
(22, 24, 'Your membership has been approved! You can start borrowing books until 2025-07-07.', 0, '2025-04-07 10:33:50'),
(23, 15, 'Your membership has been approved! You can start borrowing books until 2025-07-09.', 0, '2025-04-09 18:56:35'),
(24, 25, 'Your membership has been approved! You can start borrowing books until 2025-07-10.', 0, '2025-04-10 13:47:57'),
(25, 26, 'Your membership has been approved! You can start borrowing books until 2025-07-10.', 0, '2025-04-10 14:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_books`
--

CREATE TABLE `order_books` (
  `OrderBookdID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_books`
--

INSERT INTO `order_books` (`OrderBookdID`, `OrderID`, `BookID`) VALUES
(4, 3, 3),
(5, 4, 2),
(6, 5, 52),
(7, 6, 51),
(8, 10, 12),
(9, 10, 11),
(10, 11, 11),
(11, 12, 1),
(12, 12, 3),
(13, 12, 21),
(14, 13, 1),
(15, 14, 3),
(16, 15, 1),
(17, 16, 22),
(18, 16, 27),
(19, 16, 24),
(20, 17, 52),
(21, 17, 25),
(22, 17, 57),
(23, 18, 26),
(24, 18, 23),
(25, 19, 22),
(26, 19, 23),
(27, 20, 22),
(28, 20, 23);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Address` text NOT NULL,
  `TotalBooks` int(11) NOT NULL,
  `DeliveryFee` int(11) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `RentDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `OverdueDate` date NOT NULL,
  `ReturnDate` date DEFAULT NULL,
  `Status` enum('pending','approved','returned') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OrderID`, `UserID`, `Address`, `TotalBooks`, `DeliveryFee`, `PhoneNumber`, `RentDate`, `OverdueDate`, `ReturnDate`, `Status`) VALUES
(3, 1, 'No 33 street', 1, 4000, '234', '2025-02-21 01:59:14', '2025-03-07', NULL, 'pending'),
(4, 1, 'Thunanadar 2th street', 1, 2500, '09248268', '2025-02-21 03:43:43', '2025-03-07', NULL, 'pending'),
(5, 1, 'OX3 7xa', 1, 3000, '555', '2025-02-21 03:45:01', '2025-03-07', NULL, 'pending'),
(6, 2, 'Thunanadar 2th street', 1, 4000, '09248268', '2025-02-21 03:48:12', '2025-03-07', NULL, 'pending'),
(10, 15, 'CCC', 2, 4000, '333', '2025-03-01 00:00:00', '2025-03-15', '2025-03-01', 'pending'),
(11, 15, 'OX3 7xa', 1, 3500, '332025', '2025-03-03 00:00:00', '2025-03-17', '2025-03-03', 'pending'),
(12, 23, 'Roosevelt Drive, Headington, Oxford, OX3 7XA', 3, 2500, '123', '2025-04-02 23:00:00', '2025-04-17', '2025-04-03', 'pending'),
(13, 23, 'OX3 7xa', 1, 2500, '542025', '2025-04-04 23:00:00', '2025-04-19', '2025-04-05', 'pending'),
(14, 23, 'Thunanadar 2th street', 1, 3000, '333', '2025-04-04 23:00:00', '2025-04-19', '2025-04-05', 'pending'),
(15, 15, 'OX3 7xa', 1, 2000, '0', '2025-04-04 23:00:00', '2025-04-19', '2025-04-09', 'pending'),
(16, 15, 'OX3 7xa', 3, 3000, '555', '2025-04-05 23:00:00', '2025-04-20', '2025-04-09', 'pending'),
(17, 24, 'No 33, abc', 3, 2000, '123', '2025-04-06 23:00:00', '2025-04-21', '2025-04-07', 'pending'),
(18, 15, 'Roosevelt Drive, Headington, Oxford, OX3 7XA', 2, 2500, '999', '2025-04-08 23:00:00', '2025-04-23', '2025-04-09', 'returned'),
(19, 25, 'OX3 7xa', 2, 3000, '123', '2025-04-09 23:00:00', '2025-04-24', '2025-04-10', 'pending'),
(20, 26, 'Thunanadar 2th street', 2, 2500, '123', '2025-04-09 23:00:00', '2025-04-24', '2025-04-10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `packageplan`
--

CREATE TABLE `packageplan` (
  `PlanID` int(11) NOT NULL,
  `PlanName` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `BooksPerRent` int(10) NOT NULL,
  `RentDuration` int(11) NOT NULL,
  `Duration` int(10) NOT NULL,
  `PlanImage` varchar(10) NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packageplan`
--

INSERT INTO `packageplan` (`PlanID`, `PlanName`, `Price`, `BooksPerRent`, `RentDuration`, `Duration`, `PlanImage`, `Note`) VALUES
(1, 'Basic Package 1', '40,000 Ks', 6, 14, 3, 'plan.jpg', 'If you didn\'t return books within the \'Rent Duration\', you will be charged a fine as follows.\nOverdue Price Per Day - 0 Ks\nOverdue Price Per Week - 5,000 Ks\nOverdue Price Per Month - 10,000 Ks'),
(2, 'Basic Package 2', '70,000 Ks', 6, 14, 6, 'plan.jpg', 'If you didn\'t return books within the \'Rent Duration\', you will be charged a fine as follows. Overdue Price Per Day - 0 Ks Overdue Price Per Week - 5,000 Ks Overdue Price Per Month - 10,000'),
(3, 'Premium 1', '75,000 Ks', 12, 14, 3, 'plan.jpg', 'If you didn\'t return books within the \'Rent Duration\', you will be charged a fine as follows. Overdue Price Per Day - 0 Ks Overdue Price Per Week - 5,000 Ks Overdue Price Per Month - 10,000'),
(4, 'Premium 2', '135,000 Ks', 12, 14, 6, 'plan.jpg', 'If you didn\'t return books within the \'Rent Duration\', you will be charged a fine as follows. Overdue Price Per Day - 0 Ks Overdue Price Per Week - 5,000 Ks Overdue Price Per Month - 10,000');

-- --------------------------------------------------------

--
-- Table structure for table `paymentconfirmation`
--

CREATE TABLE `paymentconfirmation` (
  `PaymentID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `ScreenshotPath` varchar(255) NOT NULL,
  `DateSubmitted` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentconfirmation`
--

INSERT INTO `paymentconfirmation` (`PaymentID`, `PlanID`, `ScreenshotPath`, `DateSubmitted`, `UserID`, `Status`) VALUES
(10, 1, 'C1B1.jpg', '2025-03-14', 15, 'Approved'),
(12, 3, 'aboutus.jpg', '2025-03-14', 13, 'Approved'),
(13, 2, 'C1B5.jpg', '2025-03-14', 1, 'Approved'),
(14, 3, 'C1B4.jpg', '2025-03-14', 2, 'Approved'),
(15, 4, 'aboutus.jpg', '2025-03-14', 19, 'Approved'),
(29, 1, 'aboutus.jpg', '2025-04-07', 24, 'Approved'),
(30, 1, 'C4B30.jpg', '2025-04-09', 15, 'Approved'),
(31, 1, 'A.jpg', '2025-04-10', 25, 'Approved'),
(32, 1, 'A.jpg', '2025-04-10', 26, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Rating` int(10) NOT NULL,
  `Comment` text NOT NULL,
  `ReviewDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `UserID`, `BookID`, `Rating`, `Comment`, `ReviewDate`) VALUES
(1, 15, 1, 5, 'This book is incredible', '2025-03-12'),
(2, 15, 1, 2, 'Appropriate for very young kids.', '2025-03-12'),
(3, 22, 1, 1, 'Not interesting', '2025-04-03'),
(4, 15, 2, 4, 'It is a good book for kids', '2025-04-05'),
(5, 24, 22, 3, 'Good', '2025-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` enum('Normal','Member') NOT NULL DEFAULT 'Normal',
  `UserRole` enum('User','Admin') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Email`, `Phone`, `Address`, `Password`, `UserType`, `UserRole`) VALUES
(1, 'Mya Mya Win', 'myamya62@gmail.com', '0979584281', 'No.347, Thunandar 7th Street, North Okkalapa Township, Yangon', 'myamyawin62', 'Member', 'User'),
(2, 'Than Win', 'thanwin59@gmail.com', '095008591', 'No.346, Thunandar 7th Street, North Okkalapa Township, Yangon', 'thanwin59', 'Normal', 'User'),
(8, 'Olive Win', 'olive@gmail.com', '0777441726', 'No 234, Waziyar Road, Yangon', '$2y$10$BfcMbf.TqWe3o', 'Normal', 'User'),
(11, 'Daniel', 'dan@gmail.com', '234', '234', '$2y$10$TCIdffYJ0.MYj', 'Normal', 'User'),
(12, 'brookes', 'brookes@gmail.com', '01111', 'gsypy lane', '$2y$10$2K898VfUMQIVH', 'Normal', 'User'),
(13, 'oxford', 'oxford@gmail.com', '011', 'roosevelt drive', '5678', 'Member', 'User'),
(14, 'bella', 'bella@gmail.com', '007', 'Gorl Lane', '55555', 'Member', 'User'),
(15, 'abc', 'abc@gmail.com', '123', 'abc', 'abc', 'Member', 'User'),
(16, 'Naychi', 'nay@gmail.com', '555', '555', '555', 'Normal', 'Admin'),
(18, 'admin', 'admin@gmail.com', '123456', 'Admin Address', 'admin', 'Normal', 'Admin'),
(19, 'Sam Moss', 'sam@gmail.com', '333', 'ddddddddfs', 'sam', 'Normal', 'User'),
(20, 'Than Htatt Toe Win', 'htatttoe@gmail.com', '0777441726', 'No. 45, Pyay Road, Kamayut Township, Yangon, Myanmar', 'samismybf', 'Normal', 'User'),
(21, 'Ma Ma', 'mama@gmail.com', '3333', 'No3, Waziya Street', '$2y$10$7iiSRfKijrd4y', 'Normal', 'User'),
(22, 'Ko Ko Aung', 'koko@gmail.com', '44445', 'No 44, 44 street', '1500', 'Normal', 'User'),
(23, 'aa', 'aa@gmail.com', '123', 'aa', 'aa', 'Normal', 'User'),
(24, 'Emily', 'emily@gmail.com', '000124', 'no 23, abc', '1111', 'Normal', 'User'),
(25, 'myo', 'myo@gmail.com', '000', 'myo ', 'myo', 'Normal', 'User'),
(26, 'than', 'than@gmail.com', '000', 'than', 'than', 'Normal', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `usermembership`
--

CREATE TABLE `usermembership` (
  `MembershipID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usermembership`
--

INSERT INTO `usermembership` (`MembershipID`, `UserID`, `PlanID`, `StartDate`, `EndDate`, `Status`) VALUES
(1, 15, 1, '2025-03-14', '2025-06-14', 'active'),
(2, 13, 3, '2025-03-14', '2025-06-14', 'active'),
(3, 1, 2, '2025-03-14', '2025-09-14', 'active'),
(4, 2, 3, '2025-03-14', '2025-06-14', 'active'),
(5, 19, 4, '2025-03-14', '2025-09-14', 'active'),
(11, 20, 4, '2025-04-03', '0000-00-00', 'inactive'),
(12, 20, 1, '2025-04-03', '2025-04-17', 'active'),
(13, 20, 4, '2025-04-03', '2025-04-17', 'active'),
(14, 20, 2, '2025-04-03', '1970-01-01', 'inactive'),
(15, 20, 1, '2025-04-03', '2025-04-17', 'active'),
(16, 23, 1, '2025-04-03', '2025-04-17', 'active'),
(17, 23, 3, '2025-04-05', '2025-07-05', 'active'),
(18, 15, 2, '2025-04-05', '2025-10-05', 'active'),
(19, 24, 1, '2025-04-07', '2025-07-07', 'active'),
(20, 15, 1, '2025-04-09', '2025-07-09', 'active'),
(21, 25, 1, '2025-04-10', '2025-07-10', 'active'),
(22, 26, 1, '2025-04-10', '2025-07-10', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `bookauthor`
--
ALTER TABLE `bookauthor`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `bookauthor_ibfk_2` (`AuthorID`);

--
-- Indexes for table `bookkeyword`
--
ALTER TABLE `bookkeyword`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `KeywordID` (`KeywordID`);

--
-- Indexes for table `book_reservations`
--
ALTER TABLE `book_reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`KeywordID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `order_books`
--
ALTER TABLE `order_books`
  ADD PRIMARY KEY (`OrderBookdID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `packageplan`
--
ALTER TABLE `packageplan`
  ADD PRIMARY KEY (`PlanID`);

--
-- Indexes for table `paymentconfirmation`
--
ALTER TABLE `paymentconfirmation`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `PlanID` (`PlanID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BookID` (`BookID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `usermembership`
--
ALTER TABLE `usermembership`
  ADD PRIMARY KEY (`MembershipID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlanID` (`PlanID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `book_reservations`
--
ALTER TABLE `book_reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `KeywordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_books`
--
ALTER TABLE `order_books`
  MODIFY `OrderBookdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `packageplan`
--
ALTER TABLE `packageplan`
  MODIFY `PlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paymentconfirmation`
--
ALTER TABLE `paymentconfirmation`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `usermembership`
--
ALTER TABLE `usermembership`
  MODIFY `MembershipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `bookauthor`
--
ALTER TABLE `bookauthor`
  ADD CONSTRAINT `bookauthor_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `bookauthor_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`);

--
-- Constraints for table `bookkeyword`
--
ALTER TABLE `bookkeyword`
  ADD CONSTRAINT `bookkeyword_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `bookkeyword_ibfk_2` FOREIGN KEY (`KeywordID`) REFERENCES `keyword` (`KeywordID`);

--
-- Constraints for table `book_reservations`
--
ALTER TABLE `book_reservations`
  ADD CONSTRAINT `book_reservations_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `book_reservations_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `order_books`
--
ALTER TABLE `order_books`
  ADD CONSTRAINT `order_books_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `order_books_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `order_details` (`OrderID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `paymentconfirmation`
--
ALTER TABLE `paymentconfirmation`
  ADD CONSTRAINT `paymentconfirmation_ibfk_1` FOREIGN KEY (`PlanID`) REFERENCES `packageplan` (`PlanID`),
  ADD CONSTRAINT `paymentconfirmation_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`);

--
-- Constraints for table `usermembership`
--
ALTER TABLE `usermembership`
  ADD CONSTRAINT `usermembership_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `usermembership_ibfk_2` FOREIGN KEY (`PlanID`) REFERENCES `packageplan` (`PlanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
