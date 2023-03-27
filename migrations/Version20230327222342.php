<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327222342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guides ADD annee_exp INT NOT NULL, ADD annee_residence INT NOT NULL, ADD cv VARCHAR(255) NOT NULL, CHANGE experiences id_cat_guide_id INT NOT NULL');
        $this->addSql('ALTER TABLE guides ADD CONSTRAINT FK_4D7795EF76042D7A FOREIGN KEY (id_cat_guide_id) REFERENCES categorie_guide (id)');
        $this->addSql('CREATE INDEX IDX_4D7795EF76042D7A ON guides (id_cat_guide_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE guides DROP FOREIGN KEY FK_4D7795EF76042D7A');
        $this->addSql('DROP INDEX IDX_4D7795EF76042D7A ON guides');
        $this->addSql('ALTER TABLE guides ADD experiences INT NOT NULL, DROP id_cat_guide_id, DROP annee_exp, DROP annee_residence, DROP cv');
    }
}
