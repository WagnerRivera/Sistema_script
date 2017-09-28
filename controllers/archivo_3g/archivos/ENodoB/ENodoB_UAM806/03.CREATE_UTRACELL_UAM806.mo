/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE UTRACELL
// NEMONICO   : UAM806
// RNC        : SAER06
// GENERADOR  : INCOBECH
// HORA       : 16:11:21
// FECHA      : 24/08/2017
//
/////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
//                     U32617                            ///
////////////////////////////////////////////////////////////
CREATE
(
  parent "ManagedElement=1,RncFunction=1"
  identity "U32617"
  moType UtranCell
   exception none
   nrOfAttributes 10
   localCellId Integer 32617
   cId Integer 32617
   tCell Integer  2
   uarfcnUl Integer 287
   uarfcnDl Integer 687
   primaryScramblingCode Integer 140
   sib1PlmnScopeValueTag Integer 1
   locationAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=13614"
   serviceAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=13614,ServiceArea=32617"
   iubLinkRef Ref "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   administrativeState Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   absPrioCellRes Struct
      nrOfElements 4
         cellReselectionPriority Integer 3
         sPrioritySearch1 Integer 22
         sPrioritySearch2 Integer 4
         threshServingLow Integer 16
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   accessClassesBarredCs Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   accessClassesBarredPs Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   accessClassNBarred Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   admBlockRedirection Struct
      nrOfElements 3
         gsmRrc Integer 0
         rrc Integer 0
         speech Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   agpsEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   amrNbSelector Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   amrWbRateDlMax Integer 12650
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   amrWbRateUlMax Integer 12650
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   anrBlackList Integer 
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   anrIafUtranCellConfig Struct
      nrOfElements 2
         anrEnabled Integer 1
         relationAddEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   antennaPosition Struct
      nrOfElements 3
         latitudeSign Integer 1
         latitude Integer 3114527
         longitude Integer -3290424
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   aseDlAdm Integer 500
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   aseLoadThresholdUlSpeech Struct
      nrOfElements 5
         amr12200 Integer 100
         amr7950 Integer 100
         amr5900 Integer 100
         amrWb8850 Integer 100
         amrWb12650 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   aseUlAdm Integer 500
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   bchPower Integer -31
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cbsSchedulePeriodLength Integer 8
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cellBroadcastSac Integer 32617
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cellReserved Integer 1
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   cId Integer 32617
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   codeLoadThresholdDlSf128 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   compModeAdm Integer 15
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   cpcSupport Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   ctchAdmMargin Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   ctchOccasionPeriod Integer 255
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cyclicAcb Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cyclicAcbCs Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cyclicAcbPs Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dchIflsMarginCode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dchIflsMarginPower Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dchIflsThreshCode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dchIflsThreshPower Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dlCodeAdm Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dlCodeOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dlPowerOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dmcrEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dnclEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   downswitchTimer Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   eulNonServingCellUsersAdm Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   eulServingCellUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   eulServingCellUsersAdmTti2 Integer 24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   fachMeasOccaCycLenCoeff Integer 0
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   fdpchSupport Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   ganHoEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hardIfhoCorr Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hcsSib3Config Struct
      nrOfElements 3
         hcsPrio Integer 0
         qHcs Integer 0
         sSearchHcs Integer -105
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hcsUsage Struct
      nrOfElements 2
         connectedMode Integer 0
         idleMode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hoType Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsdpaUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsdpaUsersOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsdpaUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsdschInactivityTimer Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsdschInactivityTimerCpc Integer 20
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsDownswitchTrigg Struct
      nrOfElements 3
         fastDormancy Integer 0
         toFach Integer 0
         toUra Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsHighLoadThresh Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsMarginUsers Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsPowerLoadThresh Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsRedirectLoadLimit Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsSpeechMultiRabTrigg Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsThreshUsers Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   hsIflsTrigger Struct
      nrOfElements 2
         fromFach Integer 1
         fromUra Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   iFCong Integer 621
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   iFHyst Integer 6000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   iflsCpichEcnoThresh Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   iflsMode Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   iflsRedirectUarfcn Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   inactivityTimeMultiPsInteractive Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   inactivityTimer Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   inactivityTimerEnhUeDrx Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   inactivityTimerPch Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   individualOffset Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   interFreqFddMeasIndicator Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   interPwrMax Integer 30
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
//   exception none
//   iubLinkRef Integer IubLink=Iub_U32617
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   loadBasedHoSupport Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   loadBasedHoType Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   loadSharingGsmFraction Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   loadSharingGsmThreshold Integer 85
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   loadSharingMargin Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   maximumTransmissionPower Integer 425
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   maxPwrMax Integer 30
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   maxRate Integer 40690
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   interRate Integer 845
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   maxTxPowerUl Integer 24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   minimumRate Integer 370
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   minPwrMax Integer -15
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   minPwrRl Integer -120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   nOutSyncInd Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pagingPermAccessCtrl Struct
      nrOfElements 3
         locRegAcb Array Integer 15 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0
         locRegRestr Integer 0
         pagingRespRestr Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pathlossThreshold Integer 130
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   primaryCpichPower Integer 290
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   primarySchPower Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pwrAdm Integer 89
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pwrHyst Integer 300
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pwrLoadThresholdDlSpeech Struct
      nrOfElements 5
         amr12200 Integer 100
         amr5900 Integer 100
         amr7950 Integer 100
         amrWb12650 Integer 100
         amrWb8850 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   pwrOffset Integer 11
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   qHyst1 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   qHyst2 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   qQualMin Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   qRxLevMin Integer -113
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   qualMeasQuantity Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   routingAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=31312,RoutingArea=162"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   dlCodePowerCmEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   eulMcServingCellUsersAdmTti2 Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   primaryTpsCell Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   rwrEutraCc Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   tpsCellThresholds Struct
      nrOfElements 3
         tpsCellThreshEnabled Integer 0
         tpsLockThreshold Integer 5
         tpsUnlockThreshold Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   rachOverloadProtect Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   ifIratHoPsIntHsEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cellUpdateConfirmCsInitRepeat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cellUpdateConfirmPsInitRepeat Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   rateSelectionPsInteractive Struct
      nrOfElements 3
         channelType Integer 0
         dlPrefRate Integer 16
         ulPrefRate Integer 16
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   redirectUarfcn Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   releaseAseDl Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   releaseAseDlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   releaseRedirect Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   releaseRedirectEutraTriggers Struct
      nrOfElements 6
         csFallbackCsRelease Integer 0
         csFallbackDchToFach Integer 0
         dchToFach Integer 0
         fachToUra Integer 0
         fastDormancy Integer 0
         normalRelease Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   releaseRedirectHsIfls Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   reportingRange1a Integer 6
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   reportingRange1b Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   rlFailureT Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   rrcLcEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   cellBroadcastSac Integer 07451
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   secondaryCpichPower Integer -3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   secondarySchPower Integer -35
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   servDiffRrcAdmHighPrioProfile Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
    serviceRestrictions Struct
      nrOfElements 1
         csVideoCalls Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf128Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf16Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf16AdmUl Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf16gAdm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf32Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf4AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf64AdmUl Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf8Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf8AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sf8gAdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sHcsRat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sInterSearch Integer 19
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sIntraSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   spare Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   spareA Array Integer 10
      0
      1
      0
      0
      0
      0
      0
      0
      0
      0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   sRatSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   srbAdmExempt Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   standAloneSrbSelector Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   timeToTrigger1a Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   timeToTrigger1b Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   tmCongAction Integer 2000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   tmCongActionNg Integer 800
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   tmInitialG Integer 3000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   transmissionScheme Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   treSelection Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   uraRef Array Reference 1
      "ManagedElement=1,RncFunction=1,Ura=13124"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   usedFreqThresh2dEcno Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   usedFreqThresh2dRscp Integer -109
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   exception none
   userLabel String "U32617"
)

/////////////////////////////////////////////////////////////
//                        RACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   identity "1"
   moType Rach
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   aichPower Integer -2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   aichTransmissionTiming Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   constantValueCprach Integer -19
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   increasedRachCoverageEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   maxPreambleCycle Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   powerOffsetP0 Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   powerOffsetPpm Integer -4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   preambleRetransMax Integer 8
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   preambleSignatures Integer 65535
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   scramblingCodeWordNo Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   spreadingFactor Integer 32
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   subChannelNo Integer 4095
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   nb01Max Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   nb01Min Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   userLabel String "Rach 1"
)
/////////////////////////////////////////////////////////////
//                        FACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U07451"
   identity "1"
   moType Fach
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   maxFach1Power Integer 18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   maxFach2Power Integer 15
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   pOffset1Fach Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   pOffset3Fach Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Fach=1"
   exception none
   sccpchOffset Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Rach=1"
   exception none
   userLabel String "Fach 1"
)
/////////////////////////////////////////////////////////////
//                        HSDSCH                           //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32617"
   identity "1"
   moType Hsdsch
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   codeThresholdPdu656 Integer 6
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   cqiFeedbackCycle Integer 8
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaAck1 Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaAck2 Integer 7
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaCqi1 Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaCqi2 Integer 6
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaNack1 Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   deltaNack2 Integer 7
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   enhancedL2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   enhUeDrxSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   hsAqmCongCtrlSpiSupport Integer 1 2 3 4 7
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   hsAqmCongCtrlSupport Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   hsFachSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   hsMeasurementPowerOffset Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   initialAckNackRepetitionFactor Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   initialCqiRepetitionFactor Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   numHsPdschCodes Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   numHsScchCodes Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   qam64MimoSupport Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   qam64Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   exception none
   userLabel String "Hsdsch 1"
)
/////////////////////////////////////////////////////////////
//                          EUL                            //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1"
   identity "1"
   moType Eul
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   RNC Integer SAER06
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   RNC Integer SAER06
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   Site Integer UAM806
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   Site Integer UAM806
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   Utrancell Integer U32617
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   Utrancell Integer U32767
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   edchTti2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   edchTti2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingLoad Integer 32
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingLoad Integer 32
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingOverload Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingOverload Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingReportPeriod Integer 200
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingReportPeriod Integer 200
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSuspendDownSw Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSuspendDownSw Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingTimerNg Integer 1000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingTimerNg Integer 1000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulLoadTriggeredSoftCong Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulLoadTriggeredSoftCong Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulMaxTargetRtwp Integer -499
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulMaxTargetRtwp Integer -499
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulTdSchedulingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   eulTdSchedulingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   improvedL2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   improvedL2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   numEagchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   numEagchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   numEhichErgchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   numEhichErgchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   pathlossThresholdEulTti2 Integer 120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   pathlossThresholdEulTti2 Integer 120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   releaseAseUlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   releaseAseUlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   threshEulTti2Ecno Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   threshEulTti2Ecno Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32617,Hsdsch=1,Eul=1"
   exception none
   userLabel String "Eul 1"
)
////////////////////////////////////////////////////////////
//                     U32767                            ///
////////////////////////////////////////////////////////////
CREATE
(
  parent "ManagedElement=1,RncFunction=1"
  identity "U32767"
  moType UtranCell
   exception none
   nrOfAttributes 10
   localCellId Integer 32767
   cId Integer 32767
   tCell Integer  2
   uarfcnUl Integer 262
   uarfcnDl Integer 662
   primaryScramblingCode Integer 140
   sib1PlmnScopeValueTag Integer 1
   locationAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=13614"
   serviceAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=13614,ServiceArea=32767"
   iubLinkRef Ref "ManagedElement=1,RncFunction=1,IubLink=Iub_UAM806"
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   administrativeState Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   absPrioCellRes Struct
      nrOfElements 4
         cellReselectionPriority Integer 3
         sPrioritySearch1 Integer 22
         sPrioritySearch2 Integer 4
         threshServingLow Integer 16
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   accessClassesBarredCs Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   accessClassesBarredPs Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   accessClassNBarred Array Integer 16
   0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0
    0 
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   admBlockRedirection Struct
      nrOfElements 3
         gsmRrc Integer 0
         rrc Integer 0
         speech Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   agpsEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   amrNbSelector Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   amrWbRateDlMax Integer 12650
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   amrWbRateUlMax Integer 12650
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   anrBlackList Integer 
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   anrIafUtranCellConfig Struct
      nrOfElements 2
         anrEnabled Integer 1
         relationAddEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   antennaPosition Struct
      nrOfElements 3
         latitudeSign Integer 1
         latitude Integer 3114527
         longitude Integer -3290424
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   aseDlAdm Integer 500
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   aseLoadThresholdUlSpeech Struct
      nrOfElements 5
         amr12200 Integer 100
         amr7950 Integer 100
         amr5900 Integer 100
         amrWb8850 Integer 100
         amrWb12650 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   aseUlAdm Integer 500
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   bchPower Integer -31
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cbsSchedulePeriodLength Integer 8
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cellBroadcastSac Integer 32767
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cellReserved Integer 1
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   cId Integer 32767
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   codeLoadThresholdDlSf128 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   compModeAdm Integer 15
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   cpcSupport Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   ctchAdmMargin Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   ctchOccasionPeriod Integer 255
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cyclicAcb Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cyclicAcbCs Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cyclicAcbPs Struct
      nrOfElements 2
         acbEnabled Integer 0
         rotationGroupSize Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dchIflsMarginCode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dchIflsMarginPower Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dchIflsThreshCode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dchIflsThreshPower Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dlCodeAdm Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dlCodeOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dlPowerOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dmcrEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dnclEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   downswitchTimer Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   eulNonServingCellUsersAdm Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   eulServingCellUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   eulServingCellUsersAdmTti2 Integer 24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   fachMeasOccaCycLenCoeff Integer 0
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   fdpchSupport Integer 1
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   ganHoEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hardIfhoCorr Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hcsSib3Config Struct
      nrOfElements 3
         hcsPrio Integer 0
         qHcs Integer 0
         sSearchHcs Integer -105
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hcsUsage Struct
      nrOfElements 2
         connectedMode Integer 0
         idleMode Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hoType Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsdpaUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsdpaUsersOffloadLimit Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsdpaUsersAdm Integer 96
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsdschInactivityTimer Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsdschInactivityTimerCpc Integer 20
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsDownswitchTrigg Struct
      nrOfElements 3
         fastDormancy Integer 0
         toFach Integer 0
         toUra Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsHighLoadThresh Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsMarginUsers Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsPowerLoadThresh Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsRedirectLoadLimit Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsSpeechMultiRabTrigg Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsThreshUsers Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   hsIflsTrigger Struct
      nrOfElements 2
         fromFach Integer 1
         fromUra Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   iFCong Integer 621
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   iFHyst Integer 6000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   iflsCpichEcnoThresh Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   iflsMode Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   iflsRedirectUarfcn Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   inactivityTimeMultiPsInteractive Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   inactivityTimer Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   inactivityTimerEnhUeDrx Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   inactivityTimerPch Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   individualOffset Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   interFreqFddMeasIndicator Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   interPwrMax Integer 30
)

//SET
//(
//   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
//   exception none
//   iubLinkRef Integer IubLink=Iub_U32767
//)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   loadBasedHoSupport Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   loadBasedHoType Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   loadSharingGsmFraction Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   loadSharingGsmThreshold Integer 85
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   loadSharingMargin Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   maximumTransmissionPower Integer 425
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   maxPwrMax Integer 30
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   maxRate Integer 40690
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   interRate Integer 845
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   maxTxPowerUl Integer 24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   minimumRate Integer 370
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   minPwrMax Integer -15
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   minPwrRl Integer -120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   nOutSyncInd Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pagingPermAccessCtrl Struct
      nrOfElements 3
         locRegAcb Array Integer 15 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0
         locRegRestr Integer 0
         pagingRespRestr Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pathlossThreshold Integer 130
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   primaryCpichPower Integer 290
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   primarySchPower Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pwrAdm Integer 89
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pwrHyst Integer 300
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pwrLoadThresholdDlSpeech Struct
      nrOfElements 5
         amr12200 Integer 100
         amr5900 Integer 100
         amr7950 Integer 100
         amrWb12650 Integer 100
         amrWb8850 Integer 100
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   pwrOffset Integer 11
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   qHyst1 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   qHyst2 Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   qQualMin Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   qRxLevMin Integer -113
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   qualMeasQuantity Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   routingAreaRef Ref "ManagedElement=1,RncFunction=1,LocationArea=31312,RoutingArea=162"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   dlCodePowerCmEnabled Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   eulMcServingCellUsersAdmTti2 Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   primaryTpsCell Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   rwrEutraCc Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   tpsCellThresholds Struct
      nrOfElements 3
         tpsCellThreshEnabled Integer 0
         tpsLockThreshold Integer 5
         tpsUnlockThreshold Integer 5
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   rachOverloadProtect Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   ifIratHoPsIntHsEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cellUpdateConfirmCsInitRepeat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cellUpdateConfirmPsInitRepeat Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   rateSelectionPsInteractive Struct
      nrOfElements 3
         channelType Integer 0
         dlPrefRate Integer 16
         ulPrefRate Integer 16
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   redirectUarfcn Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   releaseAseDl Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   releaseAseDlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   releaseRedirect Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   releaseRedirectEutraTriggers Struct
      nrOfElements 6
         csFallbackCsRelease Integer 0
         csFallbackDchToFach Integer 0
         dchToFach Integer 0
         fachToUra Integer 0
         fastDormancy Integer 0
         normalRelease Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   releaseRedirectHsIfls Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   reportingRange1a Integer 6
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   reportingRange1b Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   rlFailureT Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   rrcLcEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   cellBroadcastSac Integer 07451
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   secondaryCpichPower Integer -3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   secondarySchPower Integer -35
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   servDiffRrcAdmHighPrioProfile Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
    serviceRestrictions Struct
      nrOfElements 1
         csVideoCalls Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf128Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf16Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf16AdmUl Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf16gAdm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf32Adm Integer 10
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf4AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf64AdmUl Integer 50
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf8Adm Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf8AdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sf8gAdmUl Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sHcsRat Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sInterSearch Integer 19
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sIntraSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   spare Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   spareA Array Integer 10
      0
      1
      0
      0
      0
      0
      0
      0
      0
      0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   sRatSearch Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   srbAdmExempt Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   standAloneSrbSelector Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   timeToTrigger1a Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   timeToTrigger1b Integer -1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   tmCongAction Integer 2000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   tmCongActionNg Integer 800
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   tmInitialG Integer 3000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   transmissionScheme Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   treSelection Integer 2
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   uraRef Array Reference 1
      "ManagedElement=1,RncFunction=1,Ura=13124"
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   usedFreqThresh2dEcno Integer -18
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   usedFreqThresh2dRscp Integer -109
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   exception none
   userLabel String "U32767"
)

/////////////////////////////////////////////////////////////
//                        RACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   identity "1"
   moType Rach
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Rach=1"
   exception none
   userLabel String "Rach 1"
)
/////////////////////////////////////////////////////////////
//                        FACH                             //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U07451"
   identity "1"
   moType Fach
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Rach=1"
   exception none
   userLabel String "Fach 1"
)
/////////////////////////////////////////////////////////////
//                        HSDSCH                           //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32767"
   identity "1"
   moType Hsdsch
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1"
   exception none
   userLabel String "Hsdsch 1"
)
/////////////////////////////////////////////////////////////
//                          EUL                            //
/////////////////////////////////////////////////////////////
CREATE
(
   parent "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1"
   identity "1"
   moType Eul
   exception none
   nrOfAttributes 0
)
SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   RNC Integer SAER06
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   RNC Integer SAER06
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   Site Integer UAM806
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   Site Integer UAM806
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   Utrancell Integer U32617
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   Utrancell Integer U32767
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   administrativeState Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   edchTti2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   edchTti2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingEnabled Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingLoad Integer 32
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingLoad Integer 32
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingOverload Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingOverload Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingReportPeriod Integer 200
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingReportPeriod Integer 200
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSuspendDownSw Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingSuspendDownSw Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingTimerNg Integer 1000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulDchBalancingTimerNg Integer 1000
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulLoadTriggeredSoftCong Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulLoadTriggeredSoftCong Integer 0
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulMaxTargetRtwp Integer -499
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulMaxTargetRtwp Integer -499
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulTdSchedulingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   eulTdSchedulingSupport Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   improvedL2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   improvedL2Support Integer 1
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   numEagchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   numEagchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   numEhichErgchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   numEhichErgchCodes Integer 4
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   pathlossThresholdEulTti2 Integer 120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   pathlossThresholdEulTti2 Integer 120
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   releaseAseUlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   releaseAseUlNg Integer 3
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   threshEulTti2Ecno Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   threshEulTti2Ecno Integer -24
)

SET
(
   mo "ManagedElement=1,RncFunction=1,UtranCell=U32767,Hsdsch=1,Eul=1"
   exception none
   userLabel String "Eul 1"
)
