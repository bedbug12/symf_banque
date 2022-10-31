<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221015123105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cheque (id INT NOT NULL, carte_gap_id INT DEFAULT NULL, frais DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_A0BBFDE9E4BA1C33 (carte_gap_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epargne (id INT NOT NULL, taux DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheque ADD CONSTRAINT FK_A0BBFDE9E4BA1C33 FOREIGN KEY (carte_gap_id) REFERENCES carte_gap (id)');
        $this->addSql('ALTER TABLE cheque ADD CONSTRAINT FK_A0BBFDE9BF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE epargne ADD CONSTRAINT FK_A19A894CBF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte ADD agence_id INT NOT NULL, ADD client_id INT NOT NULL, ADD discr VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260D725330D ON compte (agence_id)');
        $this->addSql('CREATE INDEX IDX_CFF6526019EB6921 ON compte (client_id)');
        $this->addSql('ALTER TABLE transaction ADD compte_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F2C56620 ON transaction (compte_id)');
        $this->addSql('ALTER TABLE user ADD type VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheque DROP FOREIGN KEY FK_A0BBFDE9E4BA1C33');
        $this->addSql('ALTER TABLE cheque DROP FOREIGN KEY FK_A0BBFDE9BF396750');
        $this->addSql('ALTER TABLE epargne DROP FOREIGN KEY FK_A19A894CBF396750');
        $this->addSql('DROP TABLE cheque');
        $this->addSql('DROP TABLE epargne');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260D725330D');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526019EB6921');
        $this->addSql('DROP INDEX IDX_CFF65260D725330D ON compte');
        $this->addSql('DROP INDEX IDX_CFF6526019EB6921 ON compte');
        $this->addSql('ALTER TABLE compte DROP agence_id, DROP client_id, DROP discr');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F2C56620');
        $this->addSql('DROP INDEX IDX_723705D1F2C56620 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP compte_id');
        $this->addSql('ALTER TABLE user DROP type, DROP tel, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
