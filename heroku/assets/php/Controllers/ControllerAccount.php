<?php
require_once("../Controllers/controllerPai.php");
class ControllerAccount extends ControllerPai{

    function selectAccount($request){
        $this->RequireAllFilesDrirectory("../Class");
        $account = new Account();
        $parameters = $account->SelectAcount($request);
        if($this->is_null($parameters)){
            return $this->returnresponse("Não foi possivel encontrat a conta","error");
        }
        return $this->returnresponse($parameters,"success");
    }

    function create_account($request){
        $this->RequireAllFilesDrirectory("../Class");
        $account = new Account();
        $conta = new stdClass();

        if ( strstr( $request["numero_conta"], '-' ) || floatval($request["numero_conta"]) <= 0 ) {
            return $this->returnresponse("Insira um numero valido para sua conta ","error");
        } 

        $conta->saldo = 0;
        $conta->numero_conta = $request["numero_conta"];
        $conta->tipo_conta = intval($request["tipo_conta"]);

        if( $account->InsertAcount($conta)){
            return $this->returnresponse("Conta criada com sucesso !","success");
        }else{
            return $this->returnresponse("Não foi possivel criar a conta","error");
        }

    }

    function deposito($request){
        $this->RequireAllFilesDrirectory("../Class");
        $account = new Account();
        $acoount = $account->SelectAcountById($request["conta_id"]);
        $conditional =  $acoount;
        $acoount["saldo"] += $request["valor"];
        $parameters = $account->updateAccount($acoount,$conditional);
        return $this->returnresponse("Deposito Realizado com sucesso !","success");
    }

    function saque($request){
        $this->RequireAllFilesDrirectory("../Class");
        $account = new Account();
        $acoount = $account->SelectAcountById($request["conta_id"]);
        $conditionsaccount =$account->SelectAccountType($acoount["tipo_conta"]);
        if($request["valor"] > $conditionsaccount->limite){
            return $this->returnresponse("Valor de saque maior que o limite da conta","error");
        }
        $conditional =  $acoount;
        $acoount["saldo"] -= ($request["valor"] + $conditionsaccount->taxa );
        $parameters = $account->updateAccount($acoount,$conditional);
        return $this->returnresponse("Saque Realizado com sucesso !","success");  
    }

    function transferencia($request){
        $this->RequireAllFilesDrirectory("../Class");
        $account = new Account();  
        $contatrasferencia = new stdClass();
        $contatrasferencia->numero_conta = $request["numero_conta_transfer"];
        $contatrasferencia = $account->SelectAcount($contatrasferencia);
        if($this->is_null($contatrasferencia)){
            return $this->returnresponse("Não foi possivel achar a conta de destino","error");  
        }
        $contatrasferencia = $contatrasferencia[0];
        $condition = $contatrasferencia;
        $contatrasferencia["saldo"] += floatval($request["valor"]);
        if($account->updateAccount($contatrasferencia,$condition)){
            $conta = new stdClass();
            $conta->numero_conta = $request["numero_conta"];
            $conta = $account->SelectAcount($conta)[0];
            $condition = $conta;
            $conta["saldo"] -= $request["valor"];
            if( $account->updateAccount($conta,$condition)){
                return $this->returnresponse("Trasferencia realizada com sucesso !","success");  
            }else{
                return $this->returnresponse("Não foi possivel realizar a transferencia","error");  
            }
        }else{
            return $this->returnresponse("Não foi possivel realizar a transferencia","error");  
        }
    }
}