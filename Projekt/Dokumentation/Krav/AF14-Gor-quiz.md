#AF14 - G�r quiz
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

En anv�nadare svarar p� ett quiz.

##Prim�r akt�r
+   Student

##Sekund�r akt�r
+   Systemet

##F�rkrav
+   **DF1** Logga in

##Efterkrav
+   Resultatet av quizet har sparats.

##Scenario
+ 1 - AF14 startar n�r en anv�ndare vill svara p� ett quiz
+ 2 - Systemet visar upp kurserna som anv�ndaren �r registrerad p�
+ 3 - Anv�ndaren v�ljer vilken kurs hen vill g�ra ett quiz inom
+ 4 - Systemet visar upp quiz som tillh�r kursen, samt information om vilka quiz som anv�ndaren redan har gjort
+ 5 - Anv�ndaren v�ljer vilket quiz som hen vill svara p�
+ 6 - Systemet visar fr�gorna och svarsalternativen som tillh�r quizet
+ 7 - Anv�ndaren svarar p� fr�gorna och skickar in svaret
+ 8 - Systemet presenterar anv�ndarens resultat och sparar resultatet

##Alternativscenario
+ 2a - Anv�ndaren �r inte registrerad p� n�gon kurs
    + 1 - Systemet visar ett informationsmeddelande
    + 2 - *AF14 slut*
+ 4a - Det finns inga quiz skapade inom den valda kursen
    + 1 - Systemet visar ett informationsmeddelande och erbjuder val av annan kurs
    + 2 - *Tillbaka till punkt 2*
+ 7a - Ett fel intr�ffar n�r anv�ndaren skickar in svaren
    + 1 - Systemet visar ett felmeddelande och erbjuder anv�nadren att g�ra om quizet
    + 2 -*Tillbaka till punkt 6*