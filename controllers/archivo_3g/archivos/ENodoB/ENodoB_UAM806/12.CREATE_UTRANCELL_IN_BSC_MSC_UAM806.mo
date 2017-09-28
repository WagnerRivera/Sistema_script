@COMMENT +------------------------------------------------+##
@COMMENT ¦     DEFINITION OF UTRAN CELLS IN BSC      ¦##
@COMMENT +------------------------------------------------+##
eaw
RLDEI:CELL=U32617,EXT,UTRAN;
RLDEC:CELL=U32617,FDDARFCN=687,SCRCODE=140,UTRANID=730-01-31312-32617-1326,MRSL=22;
RLDEP:CELL=U32617;
RLDEI:CELL=U32767,EXT,UTRAN;
RLDEC:CELL=U32767,FDDARFCN=662,SCRCODE=140,UTRANID=730-01-31312-32767-1326,MRSL=22;
RLDEP:CELL=U32767;

@COMMENT +------------------------------------------------+##
@COMMENT ¦     DEFINITION OF UTRAN NEIGHBOURING CELLS     ¦##
@COMMENT +------------------------------------------------+##
RLNRI:CELL=,CELLR=,SINGLE; !!

RLUMC:CELL=,ADD,UMFI=--NODIV; 

exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC ANMS01     ¦##
@COMMENT +------------------------------------------------+##
eaw ANMS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC CHMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw NE=CHMBC01,CSL=1;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC COMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw COMSS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC PMMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw PMMSS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC RAMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw RAMSS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw NE=SAMBC01,CSL=1;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMS01     ¦##
@COMMENT +------------------------------------------------+##
eaw SAMS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMSS02    ¦##
@COMMENT +------------------------------------------------+##
eaw SAMSS02;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMBC02    ¦##
@COMMENT +------------------------------------------------+##
eaw SAMBC02;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;
@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC IQMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw IQMBC01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC VAMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw VAMSS01;
@T 2

MGAAI:AREA=U32617,SAI=730-01-31312-32617;
MGAAC:AREA=U32617,RO=108,EA=0;
MGAAP:AREA=U32617;
MGLNI:LOCNO=4-56020232617;
MGLCI:LOCNO=4-56020232617,AREA=U32617;
MGLNP:LOCNO=4-56020232617;
MGLCP:AREA=U32617;
MGRCI:AREA=U32617,EC=AC01731,ERIND=1;
MGRCI:AREA=U32617,EC=AC01732,ERIND=2;
MGRCI:AREA=U32617,EC=AC01733,ERIND=3;
MGRCI:AREA=U32617,EC=AC01734,ERIND=4;
MGRCI:AREA=U32617,EC=AC01735,ERIND=5;
MGRCI:AREA=U32617,EC=AC01736,ERIND=6;
MGRCI:AREA=U32617,EC=AC01737,ERIND=7;
MGRCI:AREA=U32617,EC=AC01738,ERIND=8;
MGRCI:AREA=U32617,EC=AC01739,ERIND=9;
MGRCI:AREA=U32617,EC=AC01730,ERIND=10;
MGRCI:AREA=U32617,EC=AC01747,ERIND=11;
MGRCI:AREA=U32617,EC=AC01749,ERIND=12;
MGRCP:AREA=U32617;

MGAAI:AREA=U32767,SAI=730-01-31312-32767;
MGAAC:AREA=U32767,RO=108,EA=0;
MGAAP:AREA=U32767;
MGLNI:LOCNO=4-56020232767;
MGLCI:LOCNO=4-56020232767,AREA=U32767;
MGLNP:LOCNO=4-56020232767;
MGLCP:AREA=U32767;
MGRCI:AREA=U32767,EC=AC01731,ERIND=1;
MGRCI:AREA=U32767,EC=AC01732,ERIND=2;
MGRCI:AREA=U32767,EC=AC01733,ERIND=3;
MGRCI:AREA=U32767,EC=AC01734,ERIND=4;
MGRCI:AREA=U32767,EC=AC01735,ERIND=5;
MGRCI:AREA=U32767,EC=AC01736,ERIND=6;
MGRCI:AREA=U32767,EC=AC01737,ERIND=7;
MGRCI:AREA=U32767,EC=AC01738,ERIND=8;
MGRCI:AREA=U32767,EC=AC01739,ERIND=9;
MGRCI:AREA=U32767,EC=AC01730,ERIND=10;
MGRCI:AREA=U32767,EC=AC01747,ERIND=11;
MGRCI:AREA=U32767,EC=AC01749,ERIND=12;
MGRCP:AREA=U32767;
exit;
