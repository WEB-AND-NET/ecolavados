<?php

/**
 * Description of routes.conf
 *
 * @author Carlos Meri���o Iriarte
 */
 //Mail
 
$route['*']['/execute'] = array('MailController', 'execute');
$route['*']['/entrys/sendmail'] = array('MailController', 'sendMailToAll');
$route['*']['/downloadExcel/:pindex'] = array('MailController', 'downloadExcel');
$route['*']['/sendmail/mail'] = array('MailController', 'sendmail');


//MAIN
$route['*']['/'] = array('MainController', 'index');
$route['*']['/notificaciones/desactive'] = array('MainController', 'desactive');
$route['*']['/notificaciones/all'] = array('MainController', 'notificaciones');
$route['*']['/login'] = array('MainController', 'rutalogin');
$route['*']['/postlogin'] = array('MainController', 'login');
$route['*']['/panel/home'] = array('MainController', 'index');
$route['*']['/signup'] = array('MainController', 'rutaSignup');
$route['*']['/postsignup'] = array('MainController', 'signup');
$route['*']['/check_username_availability'] = array('MainController', 'check_username');
$route['*']['/logout'] = array('MainController', 'logout');
/*
*
*Clientes
*
*/

/*   Holidays    */
$route['*']['/holidays'] = array('HolidaysController', 'index');
$route['*']['/holidays/add'] = array('HolidaysController', 'add');
$route['*']['/holidays/save'] = array('HolidaysController', 'save');
$route['*']['/holidays/edit/:id'] = array('HolidaysController', 'edit');
$route['*']['/holidays/delete/:id'] = array('HolidaysController', 'delete');


$route['*']['/clientes'] = array('ClientesController', 'index');
$route['*']['/clientes/add'] = array('ClientesController', 'add');
$route['*']['/clientes/edit/:pindex'] = array('ClientesController', 'edit');
$route['*']['/clientes/delete/:pindex'] = array('ClientesController', 'deactivate');
$route['*']['/clientes/validar'] = array('ClientesController', 'validar');
$route['*']['/clientes/process'] = array('ClientesController', 'process');
$route['*']['/clientes/productos'] = array('ClientesController', 'getProductos');
$route['*']['/clientes/saveProcess'] = array('ClientesController', 'saveProcess');
$route['*']['/clientes/deleteProcess'] = array('ClientesController', 'deleteProcess');
$route['*']['/clientes/saveClientsProducts'] = array('ClientesController', 'saveClientsProducts');
$route['*']['/clientes/updateClientsProducts'] = array('ClientesController', 'updateClientsProducts');
$route['*']['/clientes/deleteItem'] = array('ClientesController', 'deleteItem');

/*  Profiles */

$route['*']['/profile'] = array('ProfilesController', 'index');
$route['*']['/profile/get/:id'] = array('ProfilesController', 'getProds');
$route['*']['/profile/updateImg'] = array('ProfilesController', 'cambiarImg');


$route['*']['/clientes/getContents'] = array('ClientesController', 'getContents');
$route['*']['/clientes/addProductos'] = array('ClientesController', 'addProductos');
$route['*']['/clientes/trabajosprocesos'] = array('ClientesController', 'trabajosprocesos');
$route['*']['/clientes/email/:pindex'] = array('ClientesController', 'emailIndex');
$route['*']['/clientes/email/save/all'] = array('ClientesController', 'emailSave');
$route['*']['/clientes/getClientesProductos'] = array('ClientesController', 'getClientesProductosPaquetes');
$route['*']['/clientes/getItem'] = array('ClientesController', 'getItem');
$route['*']['/clientes/check'] = array('ClientesController', 'check');
/** Clientes invoices */
$route['*']['/associate'] = array('ClientesController', 'invoices');

$route['*']['/associate'] = array('ClientesController', 'invoices');
$route['*']['/associate/:date/:pindex/:type'] = array('ClientesController', 'invoicesAssociate');


/*
*
*Unidades
*
*/

$route['*']['/units'] = array('UnitsController', 'index');
$route['*']['/units/getUnits'] = array('UnitsController', 'getUnits');
$route['*']['/units/saveUnidad'] = array('UnitsController', 'save');
$route['*']['/units/deleteItem'] = array('UnitsController', 'deleteItem');

/*
*
*Groups
*
*/

$route['*']['/groups'] = array('GroupsController', 'index');
$route['*']['/groups/getGroups'] = array('GroupsController', 'getGroups');
$route['*']['/groups/saveGroup'] = array('GroupsController', 'save');
$route['*']['/groups/deleteItem'] = array('GroupsController', 'deleteItem');




/*
*
*productos
*
*/
$route['*']['/products'] = array('ProductosController', 'index');
$route['*']['/products/add'] = array('ProductosController', 'add');
$route['*']['/products/edit/:pindex'] = array('ProductosController', 'edit');
$route['*']['/products/delete/:pindex'] = array('ProductosController', 'desactivate');
$route['*']['/products/save'] = array('ProductosController', 'save');
$route['*']['/products/validar'] = array('ProductosController', 'validar');
$route['*']['/products/getTipo'] = array('ProductosController', 'getTipo');
$route['*']['/products/saveTipo'] = array('ProductosController', 'saveTipo');
$route['*']['/products/movements/:id'] = array('ProductosController', 'movimientos');
$route['*']['/products/history/:id'] = array('ProductosController', 'history');
$route['*']['/products/categorys'] = array('ProductosController', 'categoriasIndex');
$route['*']['/products/categorys/add'] = array('ProductosController', 'categoriaAdd');
$route['*']['/products/categorys/edit/:id'] = array('ProductosController', 'categoriasEdit');
$route['*']['/products/categorys/save'] = array('ProductosController', 'categoriaSave');
$route['*']['/products/printer/:pindex'] = array('ProductosController', 'productsPrinter');
//Procedures
$route['*']['/products/procedures/:id'] = array('ProductosController', 'IndexProcedures');
$route['*']['/productos/procedures/getItems'] = array('ProductosController', 'ProceduresGetItems');
$route['*']['/productos/procedures/setItems'] = array('ProductosController', 'ProceduresSetItems');
$route['*']['/productos/procedures/setData'] = array('ProductosController', 'ProceduresSetData');
$route['*']['/productos/procedures/activities/:id'] = array('ProductosController', 'ProceduresGetActivities');
$route['*']['/productos/procedures/view/activities/:id'] = array('ProductosController', 'ProceduresViewActivities');

$route['*']['/productos/procedures/setActivity'] = array('ProductosController', 'SetProceduresGetActivities');
$route['*']['/productos/procedures/deleteActivity'] = array('ProductosController', 'deleteActivity');
$route['*']['/productos/procedures/deleteRelacion'] = array('ProductosController', 'deleteRelacion');
$route['*']['/productos/procedures/dangers'] = array('ProductosController', 'setDangers');
$route['*']['/productos/procedures/getdangers'] = array('ProductosController', 'getdangers');
/***
 * 
 * 
 * TANQUES
 */

$route['*']['/tanks'] = array('TanquesController', 'index');
$route['*']['/tanks/add'] = array('TanquesController', 'add');
$route['*']['/tanks/edit/:id'] = array('TanquesController', 'edit');
$route['*']['/tanks/delete/:pindex'] = array('TanquesController', 'deactivate');
$route['*']['/tanks/save'] = array('TanquesController', 'save');
$route['*']['/tanks/getAll'] = array('TanquesController', 'getAll');
$route['*']['/tanks/test'] = array('TanquesController', 'test');
$route['*']['/tanks/test/validate'] = array('TanquesController', 'validateTanques');
/***
 * 
 * 
 * TANQUES Client
 */

$route['*']['/tank'] = array('TanquesController', 'indexClient');
$route['*']['/tank/add'] = array('TanquesController', 'addClient');
$route['*']['/tanks/edit/:id'] = array('TanquesController', 'edit');
$route['*']['/tank/edit/:id'] = array('TanquesController', 'editClient');

$route['*']['/tank/save'] = array('TanquesController', 'saveClient');

/***
 * 
 * 
 * PAQUETES
 */

$route['*']['/packs'] = array('PaquetesController', 'index');
$route['*']['/packs/add'] = array('PaquetesController', 'add');
$route['*']['/packs/edit/:id'] = array('PaquetesController', 'edit');
$route['*']['/packs/delete/:pindex'] = array('PaquetesController', 'desactivate');
$route['*']['/packs/save'] = array('PaquetesController', 'save');
$route['*']['/packs/insert'] = array('PaquetesController', 'insert');
$route['*']['/packs/getItems'] = array('PaquetesController', 'getItems');
$route['*']['/packs/deleteItem'] = array('PaquetesController', 'deleteItem');
$route['*']['/packs/productosItem'] = array('PaquetesController', 'productosItem');
/*
*authorization
*
*/
$route['*']['/authorization'] = array('AuthorizationController', 'index');
$route['*']['/authorization/add'] = array('AuthorizationController', 'add');
$route['*']['/authorization/edit/:to/:id'] = array('AuthorizationController', 'edit');
$route['*']['/authorization/delete/:pindex'] = array('AuthorizationController', 'desactivate');
$route['*']['/authorization/save'] = array('AuthorizationController', 'save');
$route['*']['/authorization/getTanques'] = array('AuthorizationController', 'getTanques');
$route['*']['/authorization/entry/getItemsCalificaciones'] = array('AuthorizationController', 'getItemsCalificacionesByItem');
$route['*']['/authorization/entry/itemsEntrada'] = array('AuthorizationController', 'itemsEntradaSave');
$route['*']['/authorization/entry/itemsEntrada/causes_log'] = array('AuthorizationController', 'itemsEntradaSaveCauses');
$route['*']['/authorization/entry/save'] = array('AuthorizationController', 'EntrySave');
$route['*']['/authorization/entry/:id'] = array('AuthorizationController', 'entry');
$route['*']['/authorization/check/:id'] = array('AuthorizationController', 'check');
$route['*']['/authorization/sing/:id'] = array('AuthorizationController', 'singIndex');
$route['*']['/authorization/singSave/:id'] = array('AuthorizationController', 'singSave');
$route['*']['/authorization/send/:id'] = array('AuthorizationController', 'sendIER');
$route['*']['/authorization/loadTanks'] = array('AuthorizationController', 'loadIndex');
$route['*']['/autorizaciones/sendLoad'] = array('AuthorizationController', 'sendLoad');

/** authorization authorized */
$route['*']['/authorized'] = array('AuthorizationController', 'indexAuthorized');
$route['*']['/authorized/arrival/:pindex'] = array('AuthorizationController', 'indexAuthorizedUpdate');

/**  Clients Entry authorization ***/
$route['*']['/entry'] = array('AuthorizationController', 'indexEntry');
$route['*']['/entry/add'] = array('AuthorizationController', 'addEntry');
$route['*']['/entry/edit/:id'] = array('AuthorizationController', 'editEntry');
$route['*']['/entry/save'] = array('AuthorizationController', 'saveEntry');
$route['*']['/entry/saveEdit'] = array('EntrysController', 'saveEdit');

/*** Entradas*/

$route['*']['/entrys'] = array('EntrysController', 'index');
$route['*']['/entrys/csv'] = array('EntrysController', 'currentCsv');

$route['*']['/departure'] = array('EntrysController', 'departureIndex');
$route['*']['/departures/getAllDepartures'] = array('EntrysController', 'getAllDepartures');


$route['*']['/entrys/edit/:pindex'] = array('EntrysController', 'edit');
$route['*']['/entrys/gateout'] = array('EntrysController', 'gateout');


$route['*']['/entrys/clean/validate'] = array('EntrysController', 'cleanValidate');
$route['*']['/entrys/print/clean/:id'] = array('EntrysController', 'printClean');
$route['*']['/entrys/print/seals/:id'] = array('EntrysController', 'printSeals');

$route['*']['/entrys/schedule/:pindex'] = array('ScheduleController', 'scheduleIndex');
$route['*']['/entrys/schedule/add/:entry'] = array('ScheduleController', 'addSchedule');
$route['*']['/entrys/schedule/assing/:pindex'] = array('ScheduleController', 'assingSchedule');
$route['*']['/entrys/schedule/edit/:entry/:pindex'] = array('ScheduleController', 'editSchedule');
$route['*']['/entrys/schedule/close/:entry/:pindex/:request'] = array('ScheduleController', 'closeScheduleIndex');
$route['*']['/entrys/getSchedule'] = array('ScheduleController', 'getSchedule');
$route['*']['/entrys/schedule/close/calidad'] = array('ScheduleController', 'saveCloseSchedule');
$route['*']['/entrys/schedule/close/renderEvidences'] = array('ScheduleController', 'renderEvidences');
$route['*']['/entrys/schedule/close/renderEvidencesQuality'] = array('ScheduleController', 'renderEvidencesQuality');
$route['*']['/entrys/schedule/close/evidence'] = array('ScheduleController', 'closeSchedule');
$route['*']['/entrys/schedule/close/seals'] = array('ScheduleController', 'closeSeals');
$route['*']['/entrys/schedule/seals/image'] = array('ScheduleController', 'sealsImage');

$route['*']['/entrys/schedule/seals/renderSeals'] = array('ScheduleController', 'renderSeals');
$route['*']['/entrys/schedule/close'] = array('ScheduleController', 'saveEvidenceSchedule');
$route['*']['/entrys/schedule/close/quality'] = array('ScheduleController', 'saveEvidenceScheduleQ');

$route['*']['/entrys/schedule/print/:pindex'] = array('EntrysController', 'printEvidenceSchedule');
$route['*']['/entrys/schedule/permisosEmpleados'] = array('EntrysController', 'permisosEmpleados');
$route['*']['/entrys/schedule/updatePermission'] = array('EntrysController', 'updatePermission');


$route['*']['/entrys/invoice/:type/:pindex'] = array('EntrysController', 'invoice');
$route['*']['/entrys/invoice/all/associate/:pindex'] = array('EntrysController', 'associteInvoice');
$route['*']['/entrys/associate/update'] = array('EntrysController', 'updateInvoice');

$route['*']['/entry/entry/itemslimpieza'] = array('EntrysController', 'itemsLimpiezaSave');
$route['*']['/entry/entry/limpieza'] = array('EntrysController', 'limpieza');

$route['*']['/entrys/seals/:pindex'] = array('EntrysController', 'seals');
$route['*']['/entrys/clean/:pindex'] = array('EntrysController', 'clean');
$route['*']['/entrys/clean/singSave/:pindex'] = array('EntrysController', 'certificateCleanSing');

$route['*']['/entry/entry/clean/save'] = array('EntrysController', 'saveClean');
$route['*']['/entry/entry/clean/certificate/:pindex'] = array('EntrysController', 'certificateClean');



$route['*']['/entrys/calendar'] = array('EntrysController', 'calendar');
$route['*']['/entrys/calendar/load'] = array('EntrysController', 'getCalendar');



$route['*']['/entrys/save'] = array('EntrysController', 'save');
$route['*']['/entrys/save/assing'] = array('EntrysController', 'saveassing');

$route['*']['/entrys/print/:pindex'] = array('EntrysController', 'printIER');
$route['*']['/entrys/waste/:pindex'] = array('EntrysController', 'waste');
$route['*']['/entrys/waste/save/volumen'] = array('EntrysController', 'editVolumen');
$route['*']['/entrys/waste/save/bill'] = array('EntrysController', 'editBill');
$route['*']['/entrys/requests/:pindex'] = array('EntrysController', 'entrysRequest');

$route['*']['/entrys/execute'] = array('EntrysController', 'execute');
$route['*']['/entrys/execute/:work/:pindex'] = array('EntrysController', 'executeChange');
$route['*']['/entrys/info_procedure/:pindex'] = array('EntrysController', 'info_procedure');
/** Entry timeline */
$route['*']['/entrys/timeline/:pindex'] = array('EntrysController', 'timeLineInit');
/** Request */

$route['*']['/request'] = array('RequestController', 'index');
$route['*']['/request/add'] = array('RequestController', 'add');
$route['*']['/request/getrequestall'] = array('RequestController', 'getAllRequest');


$route['*']['/request/edit/:pindex'] = array('RequestController', 'edit');
$route['*']['/request/schedule/:pindex'] = array('RequestController', 'edit');

$route['*']['/request/enviar/:pindex'] = array('RequestController', 'enviar');
$route['*']['/request/getRequest'] = array('RequestController', 'getRequest');
$route['*']['/request/save'] = array('RequestController', 'save');
$route['*']['/request/getEntradas'] = array('RequestController', 'getEntradas');
$route['*']['/request/getEmails'] = array('RequestController', 'getEmails');
$route['*']['/request/getItems'] = array('RequestController', 'getItems');
$route['*']['/request/getPaquetes'] = array('RequestController', 'getPaquetes');
$route['*']['/request/getDetailsRequest'] = array('RequestController', 'getDetailsRequest');
$route['*']['/request/getClienteProductos'] = array('RequestController', 'getClienteProductos');
$route['*']['/request/print/:id'] = array('RequestController', 'printer');
$route['*']['/request/insert'] = array('RequestController', 'insert');
$route['*']['/request/not/:url/:id'] = array('RequestController', 'not');
$route['*']['/mrequest/approve/:url/:id'] = array('RequestController', 'approve');
$route['*']['/request/delete'] = array('RequestController', 'deleteItem');
$route['*']['/request/getItemsArea'] = array('RequestController', 'getItemsArea');
$route['*']['/request/authorize/:id'] = array('RequestController', 'authorize');

/**Request Client*/

$route['*']['/mrequest/approve/:id'] = array('RequestController', 'approve');
$route['*']['/mrequest/not/:url/:id'] = array('RequestController', 'not');
$route['*']['/mrequest'] = array('RequestController', 'indexRequest');
$route['*']['/mrequest/mrequest/workorder'] = array('RequestController', 'saveWorkOrder');
$route['*']['/mrequest/saveApprove'] = array('RequestController', 'saveApprove');



/*
*items
*
*/
$route['*']['/items'] = array('ItemsController', 'index');
$route['*']['/items/add'] = array('ItemsController', 'add');
$route['*']['/items/edit/:id'] = array('ItemsController', 'edit');
$route['*']['/items/delete/:pindex'] = array('ItemsController', 'desactivate');
$route['*']['/items/save'] = array('ItemsController', 'save');
$route['*']['/items/rating'] = array('ItemsController', 'ratings');
$route['*']['/items/rating/save'] = array('ItemsController', 'saveRatings');
$route['*']['/items/rating/type'] = array('ItemsController', 'saveType');
$route['*']['/items/getTanques'] = array('ItemsController', 'getTanques');
$route['*']['/items/getItems'] = array('ItemsController', 'getItems');
$route['*']['/items/saveTipo'] = array('ItemsController', 'saveTipo');
$route['*']['/items/getItemsCalificaciones'] = array('ItemsController', 'getItemsCalificaciones');

/***
 * 
 * M&R 
 * */
$route['*']['/items/mr'] = array('ItemsMrController', 'index');
$route['*']['/items/mr/add'] = array('ItemsMrController', 'add');
$route['*']['/items/mr/edit/:id'] = array('ItemsMrController', 'edit');
$route['*']['/items/mr/save'] = array('ItemsMrController', 'save');
$route['*']['/items/mr/validateCode'] = array('ItemsMrController', 'getCode');
$route['*']['/items/mr/getGuidelineItems'] = array('ItemsMrController', 'getGuidelineItems');


/**Damages**/
$route['*']['/items/mr/damages'] = array('ItemsMrController', 'damageIndex');
$route['*']['/items/mr/getDamages'] = array('ItemsMrController', 'getDamages');
$route['*']['/items/mr/saveDamages'] = array('ItemsMrController', 'saveDamages');
$route['*']['/items/mr/deleteDamages'] = array('ItemsMrController', 'deleteDamages');
/**Services**/
$route['*']['/items/mr/services'] = array('ItemsMrController', 'servicesIndex');
$route['*']['/items/mr/getServices'] = array('ItemsMrController', 'getServices');
$route['*']['/items/mr/saveServices'] = array('ItemsMrController', 'saveServices');
$route['*']['/items/mr/getService'] = array('ItemsMrController', 'getService');



//Cambio de Constrase���a
$route['*']['/cambio'] = array('CambiarController', 'index');
$route['*']['/cambiar'] = array('CambiarController', 'update');
$route['*']['/cambiar/validar'] = array('CambiarController', 'validar');

/*
*
*Roles
*
*/
$route['*']['/roles'] = array('RolesController', 'index');
$route['*']['/roles/add'] = array('RolesController', 'add');
$route['*']['/roles/edit/:pindex'] = array('RolesController', 'edit');
$route['*']['/roles/delete/:pindex'] = array('RolesController', 'deactivate');
$route['*']['/roles/save'] = array('RolesController', 'save');
$route['*']['/roles/validar'] = array('RolesController', 'validar');

/*
*
*Usuarios
*
*/
$route['*']['/usuarios'] = array('UsuariosController', 'index');
$route['*']['/usuarios/add'] = array('UsuariosController', 'add');
$route['*']['/usuarios/edit/:pindex'] = array('UsuariosController', 'edit');
$route['*']['/usuarios/delete/:pindex'] = array('UsuariosController', 'deactivate');
$route['*']['/usuarios/save'] = array('UsuariosController', 'save');
$route['*']['/usuarios/validar'] = array('UsuariosController', 'validar');
$route['*']['/perfil'] = array('PerfilesController', 'perfil');
$route['*']['/perfil/save'] = array('PerfilesController', 'perfil_save');

/***
 * 
 * Status
 * 
 */

$route['*']['/status'] = array('StatusController', 'index');
$route['*']['/status/add'] = array('StatusController', 'add');
$route['*']['/status/edit/:id'] = array('StatusController', 'edit');
$route['*']['/status/save'] = array('StatusController', 'save');
/** Works */
$route['*']['/works'] = array('WorksController', 'index');
$route['*']['/works/add'] = array('WorksController', 'add');
$route['*']['/works/edit/:id'] = array('WorksController', 'edit');
$route['*']['/works/save'] = array('WorksController', 'save');
$route['*']['/works/associate/:id'] = array('WorksController', 'associateAdd');
$route['*']['/works/associate/save'] = array('WorksController', 'associateSave');
$route['*']['/works/associate/height/save'] = array('WorksController', 'associateSaveHeight');
$route['*']['/works/associate/space/save'] = array('WorksController', 'associateSaveSpace');
$route['*']['/works/associate/hot/save'] = array('WorksController', 'associateSaveHot');
$route['*']['/works/getassociate'] = array('WorksController', 'getAssociate');
$route['*']['/works/getassociate/height'] = array('WorksController', 'getAssociateHeight');
$route['*']['/works/getassociate/space'] = array('WorksController', 'getAssociateSpace');
$route['*']['/works/getassociate/hot'] = array('WorksController', 'getAssociateHot');
/**Close Works */
$route['*']['/close_works'] = array('WorksController', 'closeIndex');
$route['*']['/close_works/:id'] = array('WorksController', 'closeWorks');
//$route['*']['/close_works/sign/2/:pindex'] = array('WorksController', 'closeWorks');
$route['*']['/close_works/signSave/:pindex'] = array('WorksController', 'singSave');


/** Task */
$route['*']['/task'] = array('TaskController', 'index');
$route['*']['/task/add'] = array('TaskController', 'add');
$route['*']['/task/edit/:id'] = array('TaskController', 'edit');
$route['*']['/task/save'] = array('TaskController', 'save');
/*** height */
$route['*']['/task/height'] = array('TaskController', 'indexHeight');
$route['*']['/task/height/add'] = array('TaskController', 'addHeight');
$route['*']['/task/height/edit/:id'] = array('TaskController', 'editHeight');
$route['*']['/task/height/save'] = array('TaskController', 'saveHeight');
/** */
$route['*']['/task/spaces'] = array('TaskController', 'indexSpace');
$route['*']['/task/spaces/add'] = array('TaskController', 'addSpace');
$route['*']['/task/spaces/edit/:id'] = array('TaskController', 'editSpace');
$route['*']['/task/spaces/save'] = array('TaskController', 'saveSpace');
/** */
$route['*']['/task/hot'] = array('TaskController', 'indexHot');
$route['*']['/task/hot/add'] = array('TaskController', 'addHot');
$route['*']['/task/hot/edit/:id'] = array('TaskController', 'editHot');
$route['*']['/task/hot/save'] = array('TaskController', 'saveHot');
/*
*
*height
*
*/
$route['*']['/ats'] = array('HeightController', 'index');
$route['*']['/height/add'] = array('HeightController', 'add');
$route['*']['/height/edit/:id'] = array('HeightController', 'edit');
$route['*']['/height/save'] = array('HeightController', 'save');
$route['*']['/height/getAssociate'] = array('HeightController', 'getAssociate');
$route['*']['/height/getBadAssociate'] = array('HeightController', 'setBadAssociate');
$route['*']['/height/setAssociate'] = array('HeightController', 'setAssociate');
$route['*']['/height/sing/:id'] = array('HeightController', 'singIndex');
$route['*']['/height/singSave/:id'] = array('HeightController', 'singSave');
$route['*']['/height/print/:id'] = array('HeightController', 'printer');
//** */
$route['*']['/spaces'] = array('SpaceController', 'index');
$route['*']['/spaces/add'] = array('SpaceController', 'add');
$route['*']['/spaces/edit/:id'] = array('SpaceController', 'edit');
$route['*']['/spaces/save'] = array('SpaceController', 'save');
$route['*']['/spaces/getAssociate'] = array('SpaceController', 'getAssociate');
$route['*']['/spaces/getBadAssociate'] = array('SpaceController', 'setBadAssociate');
$route['*']['/spaces/setAssociate'] = array('SpaceController', 'setAssociate');
$route['*']['/spaces/sing/:id'] = array('SpaceController', 'singIndex');
$route['*']['/spaces/singSave/:id'] = array('SpaceController', 'singSave');
$route['*']['/spaces/print/:id'] = array('SpaceController', 'printer');
/** */
$route['*']['/hot'] = array('HotController', 'index');
$route['*']['/hot/add'] = array('HotController', 'add');
$route['*']['/hot/edit/:id'] = array('HotController', 'edit');
$route['*']['/hot/save'] = array('HotController', 'save');
$route['*']['/hot/getAssociate'] = array('HotController', 'getAssociate');
$route['*']['/hot/getBadAssociate'] = array('HotController', 'setBadAssociate');
$route['*']['/hot/setAssociate'] = array('HotController', 'setAssociate');
$route['*']['/hot/sing/:id'] = array('HotController', 'singIndex');
$route['*']['/hot/singSave/:id'] = array('HotController', 'singSave');
/** Ats */
$route['*']['/ats'] = array('AtsController', 'index');
$route['*']['/ats/add'] = array('AtsController', 'add');
$route['*']['/ats/edit/:id'] = array('AtsController', 'edit');
$route['*']['/ats/save'] = array('AtsController', 'save');
$route['*']['/ats/getAssociate'] = array('AtsController', 'getAssociate');
$route['*']['/ats/getBadAssociate'] = array('AtsController', 'setBadAssociate');
$route['*']['/ats/setAssociate'] = array('AtsController', 'setAssociate');
$route['*']['/ats/sing/:id'] = array('AtsController', 'singIndex');
$route['*']['/ats/singSave/:id'] = array('AtsController', 'singSave');
$route['*']['/ats/print/:id'] = array('AtsController', 'printer');
$route['*']['/empleados'] = array('EmpleadosController', 'index');
$route['*']['/empleados/add'] = array('EmpleadosController', 'add');
$route['*']['/empleados/edit/:pindex'] = array('EmpleadosController', 'edit');
$route['*']['/empleados/save'] = array('EntrysController', 'sabe');
$route['*']['/empleados/validateId'] = array('EmpleadosController', 'validateId');
$route['*']['/empleados/delete/:id'] = array('EmpleadosController', 'desactive');

/**Indicators */
$route['*']['/indicators'] = array('IndicatorsController', 'index');
$route['*']['/indicators/renderIndicators'] = array('IndicatorsController', 'renderIndicators');
$route['*']['/indicators/renderIndicatorsb'] = array('IndicatorsController', 'renderIndicatorsB');
$route['*']['/indicators/timeClean/:initialdate/:finaldate'] = array('IndicatorsController', 'timeCleanReport');
$route['*']['/indicators/allEntrys/:initialdate/:finaldate'] = array('IndicatorsController', 'allEntrysReport');
$route['*']['/indicators/departures/:initialdate/:finaldate'] = array('IndicatorsController', 'salidasPDF');
$route['*']['/indicators/promedioAtencionService/:initialdate/:finaldate'] = array('IndicatorsController', 'atencionServiceReport');
$route['*']['/indicators/entrysByYear'] = array('IndicatorsController', 'entrysYear');
$route['*']['/indicators/numberStateByMonth'] = array('IndicatorsController', 'numberStateByMonth');
$route['*']['/indicators/invoicedByYear'] = array('IndicatorsController', 'invoicedByYear');
$route['*']['/indicators/totalFacturado/:initialdate/:finaldate'] = array('IndicatorsController', 'totalInvoiceReport');
$route['*']['/indicators/currenInvoiced/:initialdate/:finaldate'] = array('IndicatorsController', 'currenInvoice');
$route['*']['/indicators/detailsTime/:initialdate/:finaldate'] = array('IndicatorsController', 'detailsTime');
$route['*']['/indicators/timetoquiality/:initialdate/:finaldate'] = array('IndicatorsController', 'timetoquiality');
$route['*']['/indicators/TanquesPorEmpleado/:initialdate/:finaldate'] = array('IndicatorsController', 'TanquesPorEmpleado');
$route['*']['/indicators/timesToAirTest/:initialdate/:finaldate'] = array('IndicatorsController', 'timesToAirTest');
$route['*']['/indicators/timesInTest/:initialdate/:finaldate'] = array('IndicatorsController', 'timesInTest');
$route['*']['/indicators/RelavadoTanquesPorEmpleado/:initialdate/:finaldate'] = array('IndicatorsController', 'tanquesRelavadosEmpleado');
/**Recovert */
$route['*']['/recovery'] = array('RecoveryController', 'index');
$route['*']['recovery/salidas'] = array('RecoveryController', 'salidas');
$route['*']['recovery/details'] = array('RecoveryController', 'details');
$route['*']['recovery/deleteall'] = array('RecoveryController', 'deleteall');
/**Indicadores */
$route['*']['/indicadores'] = array('IndicatorsController', 'indexEmpleados');
$route['*']['/indicadores/renderIndicadoresEmpleados'] = array('IndicatorsController', 'renderIndicadoresEmpleados');

/***/

$route['*']['/request/change/:pindex'] = array('RequestController', 'changeRequest');
$route['*']['/spaces/getAllSpace'] = array('SpaceController', 'getAllSpace');
$route['*']['/spaces/delete'] = array('SpaceController', 'desactivate');


/**Parametros */
$route['*']['/parametros'] = array('ParametrosController', 'index');
$route['*']['/parametros/save'] = array('ParametrosController', 'save');