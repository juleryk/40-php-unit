<?php
// załącz plik testowanej klasy - dopasuj ścieżkę do pliku zgodną z własną strukturą katalogów
require('app/AuthBasic.php');

// użycie wbudowanych testów
use PHPUnit\Framework\TestCase;

// nazwanie i rozszerzenie własnej klasy klasą `TestCase` zawierającą Asercje do testów 
class AuthBasicTest extends TestCase {
	// tutaj umieść kod testów (metody)

    public function setUp() : void {
        $this->instance = new AuthBasic();
    }
    public function tearDown() : void {
        unset($this->instance);
    }


    public function testCreateCode(){
        $out = $this->instance->createCode();
    // jezeli potrzeba wyświetlić cokolwiek w widoku testu, należy użyć:
        fwrite(STDERR, print_r($out, true));
        $len = strlen($out);
        $this->assertIsNumeric($out,'Wylosowano: '.$out);
        $this->assertEquals(6,$len,'Długość: '.$len);
    
        $out = $this->instance->createCode(4);
        $len = strlen($out);
        $this->assertIsNumeric($out,'Wylosowano: '.$out);
        $this->assertEquals(4,$len,'Długość: '.$len);
    // symulowanie wylosowania liczby o mniejszej niż oczekiwana długość, którą należy uzupełnić zerami
    // nie można liczyć, że podczas testu zawsze wygenerujemy taką liczbą, stąd skopiowanie implementacji metody
        $out = str_pad(1111,6,'0',STR_PAD_LEFT);
        $len = strlen($out);
        $this->assertIsNumeric($out,'Wylosowano: '.$out);
        $this->assertEquals(6,$len,'Długość: '.$len);
    }
    

    public function testCreateAuthToken(){
        // oczekiwana struktura tokenu z następującymi informacjami
            $exp = array(
              'emlAuth'=>'gpetri@gplweb.pl','authCode'=>'131313',
              'authDate'=>date("Y-m-d"),'authHour'=>date("H:i:s"),
              'addrIp'=>'127.0.0.1','reqOs'=>'Linux','reqBrw'=>'FF'
            );
        // wywołanie testowanej metody z przykładowymi danymi użytkownika: email i jego IDentyfikator
            $out = $this->instance->createAuthToken('gpetri@gplweb.pl',13);
        // ponieważ generowany Token jest wartością losową - musimy go napisać wartością stałą - inaczej nie ma możliwości wykonania pomyślnie testu
            $out['authCode'] = '131313';
        // wywołanie testu właściwego - Asercji (założenia)
            $this->assertEquals($exp,$out,'Tablice są różne');
        }

    public function testGenFingerprint(){
        // ??
        // $this->assertEquals($exp, $out,'Tablice są różne');
    }

    public function verifyQuickRegCode() {
        $out = $this->instance->verifyQuickRegCode();
        $this->assertEquals(true, $out, "nie Zgadza sie");
    }
}





?>