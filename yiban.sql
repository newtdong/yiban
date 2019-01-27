/*
 Navicat Premium Data Transfer

 Source Server         : Tencent
 Source Server Type    : MySQL
 Source Server Version : 50643
 Source Host           : 123.207.140.223:3306
 Source Schema         : yiban

 Target Server Type    : MySQL
 Target Server Version : 50643
 File Encoding         : 65001

 Date: 27/01/2019 21:13:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `response` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `turenum` int(11) NULL DEFAULT NULL,
  `optionA` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `optionB` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `optionC` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `optionD` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES (1, '（    ）明确指出：\"‘文化大革命’是一场由领导者错误发动，被反革命集团利用，给党、国家和各族人民带来严重灾难的内乱。\"', 'B', NULL, NULL, '《中国共产党第十一届中央委员会第三次全体会议决议》', '《中国攻共产党中央委员会关于建国以来党的若干历史问题的决议》', '《中国共产党中央关于经济体制改革的决定》', NULL);
INSERT INTO `question` VALUES (2, '（ ）问题，是社会主义建设首先必须把握的基本战略问题。', 'B', NULL, NULL, '经济基础与上层建筑的关系', '时代主题', '姓\"资\" 姓\"社\"', 'test');
INSERT INTO `question` VALUES (3, '（   ）是当代世界的两大主题。', 'B', NULL, NULL, '战争与和平 ', '和平与发展', '发展与环保', NULL);
INSERT INTO `question` VALUES (4, '\"科学技术是第一生产力\"的论断是（   ）提出的。', 'C', NULL, NULL, '马克思 ', '列宁 ', '邓小平', NULL);
INSERT INTO `question` VALUES (5, '（ ）年中国国民生产总值大体和日本相等。', 'A', NULL, NULL, '1960', '1950  ', '1940', NULL);
INSERT INTO `question` VALUES (6, '1977年（ ），《人民日报》、《红旗》杂志、《解放军报》同时的发表的社论提出\"两个凡是\"的指导方针。', 'A', NULL, NULL, '2月7日 ', '2月8日', '2月9日', NULL);
INSERT INTO `question` VALUES (7, '（   ）年4月，邓小平在给党中央的信中提出：\"我们必须世世代代地用准确的完整的毛泽东思想来指导我们全党、全军和全国人民。\"', 'B', NULL, NULL, '1976', '1977', '1978', NULL);
INSERT INTO `question` VALUES (8, '1978年（  ），《光明日报》发表《实践是检验真理的唯一标准》一文。  ', 'B', NULL, NULL, '5月10日 ', '5月11日', '5月12日', NULL);
INSERT INTO `question` VALUES (9, '1978年5月11日，《光明日报》发表（   ）一文，引发了真理标准大讨论。', 'B', NULL, NULL, '《实践是检验真理的标准》', '《实践是检验真理的唯一标准》', '《实践是检验真理的基本标准》', NULL);
INSERT INTO `question` VALUES (10, '1978年11月10日至12月15日党中央在北京召开工作会议，（  ）率先提出系统地解决历史遗留问题的意见，引起大多数与会者的强烈反响，从而改变了会议议程。', 'A', NULL, NULL, '陈云   ', '邓小平', '李先念', NULL);
INSERT INTO `question` VALUES (11, '邓小平在（ ）闭幕会上作题为《解放思想，实事求是，团结一致向前看》的讲话。', 'B', NULL, NULL, '中国共产党第十一届中央委员会第三次全体会议', '1978年12月的中央工作会议', '中国共产党第十二次全国代表大会', NULL);
INSERT INTO `question` VALUES (12, '1978年12月18日至22日，（  ）在北京召开。', 'A', NULL, NULL, '中国共产党第十一届中央委员会第三次全体会议', '中国共产党第十一届中央委员会第四次全体会议', '中国共产党第十一届中央委员会第五次全体会议', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `userid` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usernick` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `money` int(255) NULL DEFAULT NULL,
  `userhead` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `schoolid` int(11) NULL DEFAULT NULL,
  `schoolname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `regtime` datetime(0) NULL DEFAULT NULL,
  `score` int(11) NOT NULL,
  `subtime` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT '用时，用秒表示',
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
