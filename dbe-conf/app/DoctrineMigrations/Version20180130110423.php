<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180130110423 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slide (id INT AUTO_INCREMENT NOT NULL, lecture_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, name LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_72EFEE6235E32FCD (lecture_id), INDEX IDX_72EFEE62EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture (id INT AUTO_INCREMENT NOT NULL, section_id INT DEFAULT NULL, start_at TIME NOT NULL, name LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C1677948D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, lecture_id INT NOT NULL, content LONGTEXT DEFAULT NULL, answered TINYINT(1) NOT NULL, accepted TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B6F7494E35E32FCD (lecture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, knowledge_base_id INT DEFAULT NULL, agenda LONGTEXT DEFAULT NULL, name LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2D737AEF1620F1CE (knowledge_base_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_answer (id INT AUTO_INCREMENT NOT NULL, slide_id INT DEFAULT NULL, guest_id INT DEFAULT NULL, INDEX IDX_F2D38249DD5AFB87 (slide_id), INDEX IDX_F2D382499A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE knowledge_base (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE knowledge_bases_medias (knowledge_base_id INT NOT NULL, pdf_id INT NOT NULL, INDEX IDX_DF17874D1620F1CE (knowledge_base_id), INDEX IDX_DF17874D511FC912 (pdf_id), PRIMARY KEY(knowledge_base_id, pdf_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, type LONGTEXT NOT NULL, name LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, media_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pdf (id INT NOT NULL, file_name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, possible_answer_id INT DEFAULT NULL, survey_answer_id INT DEFAULT NULL, survey_question_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_DADD4A25BE410D03 (possible_answer_id), INDEX IDX_DADD4A25F650A2A (survey_answer_id), INDEX IDX_DADD4A25A6DF29BA (survey_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_question (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, type LONGTEXT NOT NULL, name LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_questions_possible_answers (survey_question_id INT NOT NULL, possible_answer_id INT NOT NULL, INDEX IDX_3AA70C9A6DF29BA (survey_question_id), INDEX IDX_3AA70C9BE410D03 (possible_answer_id), PRIMARY KEY(survey_question_id, possible_answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, slide_id INT NOT NULL, guest_id INT NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CFBDFA14DD5AFB87 (slide_id), INDEX IDX_CFBDFA149A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, alt LONGTEXT DEFAULT NULL, title LONGTEXT DEFAULT NULL, file_name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE html (id INT NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surveys_questions (survey_id INT NOT NULL, survey_question_id INT NOT NULL, INDEX IDX_EBCE2EFB3FE509D (survey_id), INDEX IDX_EBCE2EFA6DF29BA (survey_question_id), PRIMARY KEY(survey_id, survey_question_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE possible_answer (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, name LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, email LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guests_pdfs (guest_id INT NOT NULL, pdf_id INT NOT NULL, INDEX IDX_C7BBD2999A4AA658 (guest_id), INDEX IDX_C7BBD299511FC912 (pdf_id), PRIMARY KEY(guest_id, pdf_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE6235E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF1620F1CE FOREIGN KEY (knowledge_base_id) REFERENCES knowledge_base (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D38249DD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D382499A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE knowledge_bases_medias ADD CONSTRAINT FK_DF17874D1620F1CE FOREIGN KEY (knowledge_base_id) REFERENCES knowledge_base (id)');
        $this->addSql('ALTER TABLE knowledge_bases_medias ADD CONSTRAINT FK_DF17874D511FC912 FOREIGN KEY (pdf_id) REFERENCES pdf (id)');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8CBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25BE410D03 FOREIGN KEY (possible_answer_id) REFERENCES possible_answer (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25F650A2A FOREIGN KEY (survey_answer_id) REFERENCES survey_answer (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A6DF29BA FOREIGN KEY (survey_question_id) REFERENCES survey_question (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE survey_questions_possible_answers ADD CONSTRAINT FK_3AA70C9A6DF29BA FOREIGN KEY (survey_question_id) REFERENCES survey_question (id)');
        $this->addSql('ALTER TABLE survey_questions_possible_answers ADD CONSTRAINT FK_3AA70C9BE410D03 FOREIGN KEY (possible_answer_id) REFERENCES possible_answer (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14DD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA149A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE html ADD CONSTRAINT FK_1879F8E5BF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey ADD CONSTRAINT FK_AD5F9BFCBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE surveys_questions ADD CONSTRAINT FK_EBCE2EFB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('ALTER TABLE surveys_questions ADD CONSTRAINT FK_EBCE2EFA6DF29BA FOREIGN KEY (survey_question_id) REFERENCES survey_question (id)');
        $this->addSql('ALTER TABLE guests_pdfs ADD CONSTRAINT FK_C7BBD2999A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE guests_pdfs ADD CONSTRAINT FK_C7BBD299511FC912 FOREIGN KEY (pdf_id) REFERENCES pdf (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D38249DD5AFB87');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14DD5AFB87');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE6235E32FCD');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35E32FCD');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948D823E37A');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25F650A2A');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF1620F1CE');
        $this->addSql('ALTER TABLE knowledge_bases_medias DROP FOREIGN KEY FK_DF17874D1620F1CE');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62EA9FDD75');
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8CBF396750');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBF396750');
        $this->addSql('ALTER TABLE html DROP FOREIGN KEY FK_1879F8E5BF396750');
        $this->addSql('ALTER TABLE survey DROP FOREIGN KEY FK_AD5F9BFCBF396750');
        $this->addSql('ALTER TABLE knowledge_bases_medias DROP FOREIGN KEY FK_DF17874D511FC912');
        $this->addSql('ALTER TABLE guests_pdfs DROP FOREIGN KEY FK_C7BBD299511FC912');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25A6DF29BA');
        $this->addSql('ALTER TABLE survey_questions_possible_answers DROP FOREIGN KEY FK_3AA70C9A6DF29BA');
        $this->addSql('ALTER TABLE surveys_questions DROP FOREIGN KEY FK_EBCE2EFA6DF29BA');
        $this->addSql('ALTER TABLE surveys_questions DROP FOREIGN KEY FK_EBCE2EFB3FE509D');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25BE410D03');
        $this->addSql('ALTER TABLE survey_questions_possible_answers DROP FOREIGN KEY FK_3AA70C9BE410D03');
        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D382499A4AA658');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA149A4AA658');
        $this->addSql('ALTER TABLE guests_pdfs DROP FOREIGN KEY FK_C7BBD2999A4AA658');
        $this->addSql('DROP TABLE slide');
        $this->addSql('DROP TABLE lecture');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE survey_answer');
        $this->addSql('DROP TABLE knowledge_base');
        $this->addSql('DROP TABLE knowledge_bases_medias');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE pdf');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE survey_question');
        $this->addSql('DROP TABLE survey_questions_possible_answers');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE html');
        $this->addSql('DROP TABLE survey');
        $this->addSql('DROP TABLE surveys_questions');
        $this->addSql('DROP TABLE possible_answer');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE guests_pdfs');
    }
}
