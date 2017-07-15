<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170714204505 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE threads');
        $this->addSql('ALTER TABLE rubric CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rubric_criterion CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rubric_criterion_level CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE comments ADD comment_id VARCHAR(255) NOT NULL, ADD parent INT NOT NULL, ADD content VARCHAR(255) NOT NULL, ADD user_id INT NOT NULL, ADD fullname VARCHAR(255) NOT NULL, ADD upvote_count INT NOT NULL, ADD user_has_upvoted TINYINT(1) NOT NULL, DROP ancestors, DROP depth, DROP state, DROP previous_state, DROP thread_id, DROP created_at, CHANGE body created_by_current_user LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE import_logs CHANGE is_read is_read TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE ls_association CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_association_grouping CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_concept CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_grade CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_item_type CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_licence CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_subject CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_doc CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_item DROP type, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE salt_user CHANGE locked locked TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE threads (id VARCHAR(100) NOT NULL COLLATE utf8_bin, is_commentable TINYINT(1) NOT NULL, num_comments INT NOT NULL, last_comment_at DATETIME DEFAULT NULL, permalink TEXT NOT NULL COLLATE utf8_bin) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD ancestors VARCHAR(255) NOT NULL COLLATE utf8_bin, ADD depth INT NOT NULL, ADD state INT NOT NULL, ADD previous_state INT DEFAULT 0 NOT NULL, ADD thread_id VARCHAR(255) NOT NULL COLLATE utf8_bin, ADD created_at DATETIME DEFAULT \'0000-00-00 00:00:00\', DROP comment_id, DROP parent, DROP content, DROP user_id, DROP fullname, DROP upvote_count, DROP user_has_upvoted, CHANGE created_by_current_user body TEXT NOT NULL COLLATE utf8_bin');
        $this->addSql('ALTER TABLE import_logs CHANGE is_read is_read TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE ls_association CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_association_grouping CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_concept CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_grade CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_item_type CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_licence CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_def_subject CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_doc CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ls_item ADD type VARCHAR(60) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rubric CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rubric_criterion CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rubric_criterion_level CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE salt_user CHANGE locked locked TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
