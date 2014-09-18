#DF1 - Logga in
<table>
    <tr>
        <th>Datum</th>
        <th>H�ndelse</th>
        <th>F�rfattare</th>
    </tr>
    <tr>
        <td>18/9-2014</td>
        <td>Skapades</td>
        <td>Svante Arvedson</td>
    </tr>
</table>

Anv�ndaren autentiserar sig och loggar in i systemet.

##Prim�r akt�r
+   Anv�ndare

##Sekund�r akt�r
+   Systemet

##F�rkrav
Inga f�rkrav.

##Efterkrav
Anv�ndaren ska vara inloggad.

##Scenario
+ 1 - DF1 startar n�r en anv�ndare vill autentisera sig och logga in
+ 2 - Systemet presenterar ett inloggningsformul�r
+ 3 - Anv�ndaren matar in sina [autentisieringsuppgifter](../Ordlista.md)
+ 4 - Systemet loggar in anv�ndaren

##Alternativscenario
+ 3a - Anv�ndarens uppgifter �r felaktiga
    + 1 - Systemet visar felmeddelande
    + 2 - *G� tillbaka till punkt 3*
+ 4a - Ett fel intr�ffar n�r systemet ska logga in personen
    + 1 - Systemet visar ett felmeddelande
    + 2 - *G� tillbaka till punkt 3*