<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181023182806 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_user DROP FOREIGN KEY FK_43D062A586383B10');
        $this->addSql('DROP INDEX UNIQ_43D062A586383B10 ON service_user');
        $this->addSql('ALTER TABLE service_user DROP avatar_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_user ADD avatar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_user ADD CONSTRAINT FK_43D062A586383B10 FOREIGN KEY (avatar_id) REFERENCES pictures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_43D062A586383B10 ON service_user (avatar_id)');
    }
}