<h1 align="left">Technická dokumentácia</h1>

###

<h2 align="left">Obsah</h2>

###

<p align="left">1. Úvod<br>2. Systémové požiadavky<br>3. Administrátorské údaje<br>4. Inštalácia a konfigurácia<br>5. Nastavenie databázy<br>6. Registrácia užívateľa<br>7. Dvojfaktorová autentifikácia (2FA)<br>8. Riešenie problémov<br>9. Vývojári aplikácie<br>10. Rozdelenie úloh medzi zúčastnenými<br>11. Záver</p>

###

<h2 align="left">1. Úvod</h2>

###

<p align="left">Webová aplikácia je vyvinutá pomocou programovacieho jazyka PHP a na ukladanie dát využíva databázu MySQL. Poskytuje funkciu registrácie používateľov s voliteľným dvojfaktorovým overením (2FA) pre zvýšenie bezpečnosti.</p>

###

<h2 align="left">2. Systémové požiadavky</h2>

###

<p align="left">Ak chcete spustiť webovú aplikáciu, musia byť splnené nasledujúce systémové požiadavky:<br><br>- PHP verzia 7.0 alebo vyššia<br>- MySQL databáza<br>- phpMyAdmin na správu databázy<br>– webový server - Nginx</p>

###

<h2 align="left">3. Administrátorske údaje</h2>

###

<p align="left">- login<br> - password<br> - databáza</p>

###

<h2 align="left">4. Inštalácia a konfigurácia</h2>

###

<p align="left">1. Stiahnite si zdrojový kód webovej aplikácie.<br>2. Umiestnite zdrojový kód do koreňového adresára vášho webového servera.<br>3. Uistite sa, že PHP je správne nainštalované a nakonfigurované na vašom serveri.<br>4. Nakonfigurujte svoj webový server, aby obsluhoval aplikáciu.<br>5. Upravte konfiguračný súbor, aby ste nastavili parametre pripojenia k databáze, ako je hostiteľ databázy, meno užívateľa, heslo a názov databázy.</p>

###

<h2 align="left">5. Nastavenie databázy</h2>

###

<p align="left">1. Vstúpte do phpMyAdmin a prihláste sa.<br>2. Vytvorte novú databázu pre webovú aplikáciu.<br>3. Importujte poskytnutý súbor SQL a vytvorte potrebné tabuľky.<br>4. Uistite sa, že užívateľ databázy zadaný v konfiguračnom súbore má príslušné povolenia pre novovytvorenú databázu.</p>

###

<h2 align="left">6. Registrácia užívateľa</h2>

###

<p align="left">Funkcia registrácie používateľov umožňuje používateľom vytvárať účty a pristupovať k webovej aplikácii.<br><br>1. Prejdite na stránku registrácie.<br>2. Vyplňte požadované polia, ako napríklad používateľské meno, e-mail a heslo.<br>3. Odošlite registračný formulár.<br>4. Overte poskytnuté informácie, ako je kontrola duplicitných používateľských mien alebo e-mailových adries.<br>5. Ak je overenie úspešné, uložte informácie o používateľovi do databázy.<br>6. Zobrazte správu o úspechu a presmerujte používateľa na prihlasovaciu stránku.</p>

###

<h2 align="left">7. Dvojfaktorová autentifikácia (2FA)</h2>

###

<p align="left">Funkcia dvojfaktorového overenia pridáva užívateľským účtom ďalšiu vrstvu zabezpečenia.<br><br>1. Nainštalujte knižnicu 2FA (napr. Google Authenticator).<br>2. Povoľte funkciu 2FA v nastaveniach používateľského účtu.<br>3. Vygenerujte tajný kľúč a zobrazte QR kód.<br>4. Vyzvite používateľa, aby naskenoval QR kód pomocou mobilnej aplikácie 2FA.<br>5. Uložte tajný kľúč bezpečne v používateľskom účte.<br>6. Overte 2FA kód zadaný používateľom počas prihlasovania.<br>7. Ak je kód správny, povoľte používateľovi prihlásiť sa. V opačnom prípade sa zobrazí chybové hlásenie.</p>

###

<h2 align="left">8. Riešenie problémov</h2>

###

<p align="left">Ak sa počas inštalácie alebo používania webovej aplikácie vyskytnú nejaké problémy alebo chyby, postupujte podľa nasledujúcich krokov na riešenie problémov:<br><br>1. Skontrolujte, či protokoly servera neobsahujú chybové správy.<br>2. Overte, či verzia PHP spĺňa požiadavky.<br>3. Skontrolujte, či sú parametre pripojenia k databáze správne nakonfigurované.<br>4. Skontrolujte, či existujú potrebné databázové tabuľky a stĺpce.<br>5. Dvakrát skontrolujte oprávnenia súboru a uistite sa, že umožňujú správny prístup na čítanie/zápis.</p>

###

<h2 align="left">9. Vývojári aplikácie</h2>

###

<p align="left">Pri vývoji tejto webovej aplikácie zúčastnili sa: <br><br>Alexandra Kremničanová<br>Marián Vrábel<br>Boris Osuský<br>Alen Blažek</p>

###

<h2 align="left">10. Rozdelenie úloh medzi zúčastnenými:</h2>

###

<p align="left">1. Alexandra Kremničanová<br><br> - frontend aplikácie (vzhľad)<br> - dvojjazyčnosť <br> - matematický editor<br><br>2. Marián Vrábel<br><br> - registrovanie a prihlasovanie do aplikácie<br> - parsovanie LaTex súborov<br> - generovanie PDF<br> - tabuľka Users v databáze<br><br>3. Boris Osuský<br><br><br> - vytvorenie databázy<br> - vygenerovanie príkladov na riešenie<br> - generovanie úlohy a obrázka pre študenta, zápis odpovede do databázy a vyhodnotenie jeho odpovede<br> - prehľad zadaných úloh<br> - API<br> - vloženie LaTeX súborov do aplikácie<br><br>4. Alen Blažek<br><br> - parsovanie LaTex súborov<br> - návod na použitie aplikácie<br> - technická dokumentácia<br> - Docker balíček</p>

###

<h2 align="left">11. Záver</h2>

###

<p align="left">Táto dokumentácia poskytuje prehľad webovej aplikácie kódovanej v PHP s využitím databázy MySQL v phpMyAdmin. Zahŕňa inštaláciu, nastavenie databázy, registráciu používateľov a implementáciu dvojfaktorovej autentifikácie. Dodržiavanie týchto pokynov pomôže používateľom efektívne nastaviť a používať webovú aplikáciu.</p>

###