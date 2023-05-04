<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501204646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B138212C041E');
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B1382A5E6616');
        $this->addSql('ALTER TABLE réponses DROP FOREIGN KEY réponses_ibfk_1');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY fk_user_reclamation');
        $this->addSql('ALTER TABLE relation1 DROP FOREIGN KEY fk_evenement_sponsor1');
        $this->addSql('ALTER TABLE relation1 DROP FOREIGN KEY evenement_fk_sponsonring2');
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY fk_verfication_user');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY fk_user');
        $this->addSql('DROP TABLE demandecovoiturageback');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE maintenance');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE participate');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE réponses');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE relation1');
        $this->addSql('DROP TABLE sondage');
        $this->addSql('DROP TABLE sponsoring');
        $this->addSql('DROP TABLE verification');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('ALTER TABLE bien ADD iduser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_45EDC386786A81FB ON bien (iduser_id)');
        $this->addSql('ALTER TABLE demandecovoiturage DROP FOREIGN KEY FK_BD406450A76ED395');
        $this->addSql('DROP INDEX IDX_BD406450A76ED395 ON demandecovoiturage');
        $this->addSql('ALTER TABLE demandecovoiturage CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE offrecovoiturage DROP FOREIGN KEY FK_66D209D4786A81FB');
        $this->addSql('DROP INDEX UNIQ_66D209D4786A81FB ON offrecovoiturage');
        $this->addSql('ALTER TABLE offrecovoiturage CHANGE iduser_id idUser INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offrecovoiturage ADD CONSTRAINT FK_66D209D4FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66D209D4FE6E88D7 ON offrecovoiturage (idUser)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demandecovoiturageback (id INT AUTO_INCREMENT NOT NULL, dateReservation DATETIME NOT NULL, nbPlace INT NOT NULL, id_usr INT NOT NULL, id_offre INT NOT NULL, UNIQUE INDEX id_offre (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATETIME NOT NULL, titre VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nbparticipants INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maintenance (id_maintenance INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, datedassurance DATETIME NOT NULL, datepassurance DATETIME NOT NULL, datedvidange DATETIME NOT NULL, restekilometre INT NOT NULL, PRIMARY KEY(id_maintenance)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_depart DATE NOT NULL, lieu_depart VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lieu_arrive VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nb_places INT NOT NULL, distance INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participate (id INT AUTO_INCREMENT NOT NULL, id_usr_id INT DEFAULT NULL, id_event_id INT DEFAULT NULL, INDEX IDX_D02B138212C041E (id_event_id), INDEX IDX_D02B1382A5E6616 (id_usr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE questions (Question_id INT NOT NULL, question VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, sondage_id INT NOT NULL, PRIMARY KEY(Question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE réponses (réponses_id INT AUTO_INCREMENT NOT NULL, réponse VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Question_id INT NOT NULL, INDEX Question_id (Question_id), PRIMARY KEY(réponses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, contenu VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX fk_user_reclamation (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE relation1 (id_relation INT AUTO_INCREMENT NOT NULL, id_sponsor INT NOT NULL, id_evenement INT NOT NULL, INDEX fk_evenement_sponsor1 (id_evenement), INDEX evenement_fk_sponsonring2 (id_sponsor), PRIMARY KEY(id_relation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sondage (sondage_id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categorie VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(sondage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsoring (id INT AUTO_INCREMENT NOT NULL, sponsor VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, montant DOUBLE PRECISION NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateSignature DATE NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE verification (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX fk_verfication_user (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voiture (id_voiture INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, puissance INT NOT NULL, kilometrage INT NOT NULL, nbplaces INT NOT NULL, dateAssurance DATE NOT NULL, dateDVidange DATE NOT NULL, color VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, marque VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX idUser (idUser), PRIMARY KEY(id_voiture)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B138212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B1382A5E6616 FOREIGN KEY (id_usr_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE réponses ADD CONSTRAINT réponses_ibfk_1 FOREIGN KEY (Question_id) REFERENCES questions (Question_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT fk_user_reclamation FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation1 ADD CONSTRAINT fk_evenement_sponsor1 FOREIGN KEY (id_evenement) REFERENCES evenement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation1 ADD CONSTRAINT evenement_fk_sponsonring2 FOREIGN KEY (id_sponsor) REFERENCES sponsoring (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT fk_verfication_user FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT fk_user FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386786A81FB');
        $this->addSql('DROP INDEX IDX_45EDC386786A81FB ON bien');
        $this->addSql('ALTER TABLE bien DROP iduser_id');
        $this->addSql('ALTER TABLE demandecovoiturage CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demandecovoiturage ADD CONSTRAINT FK_BD406450A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BD406450A76ED395 ON demandecovoiturage (user_id)');
        $this->addSql('ALTER TABLE offrecovoiturage DROP FOREIGN KEY FK_66D209D4FE6E88D7');
        $this->addSql('DROP INDEX IDX_66D209D4FE6E88D7 ON offrecovoiturage');
        $this->addSql('ALTER TABLE offrecovoiturage CHANGE idUser iduser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offrecovoiturage ADD CONSTRAINT FK_66D209D4786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66D209D4786A81FB ON offrecovoiturage (iduser_id)');
    }
}
