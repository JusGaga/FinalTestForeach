<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411090021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gladiateur (id INT AUTO_INCREMENT NOT NULL, ludi_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, adresse DOUBLE PRECISION NOT NULL, strenght DOUBLE PRECISION NOT NULL, equilibre DOUBLE PRECISION NOT NULL, vitesse DOUBLE PRECISION NOT NULL, strat DOUBLE PRECISION NOT NULL, entrainer TINYINT(1) NOT NULL, INDEX IDX_C4F56ED0390910BB (ludi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ludi (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, spe VARCHAR(255) NOT NULL, complet TINYINT(1) NOT NULL, INDEX IDX_37714A43A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, bourse INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gladiateur ADD CONSTRAINT FK_C4F56ED0390910BB FOREIGN KEY (ludi_id) REFERENCES ludi (id)');
        $this->addSql('ALTER TABLE ludi ADD CONSTRAINT FK_37714A43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gladiateur DROP FOREIGN KEY FK_C4F56ED0390910BB');
        $this->addSql('ALTER TABLE ludi DROP FOREIGN KEY FK_37714A43A76ED395');
        $this->addSql('DROP TABLE gladiateur');
        $this->addSql('DROP TABLE ludi');
        $this->addSql('DROP TABLE user');
    }
}
