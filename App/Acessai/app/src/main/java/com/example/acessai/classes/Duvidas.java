package com.example.acessai.classes;

public class Duvidas {
    private int idDuvida;
    private String msgDuvida;
    private String respDuvida;
    private String nomeProf;
    private String nomeAluno;
    private String dataHoraMsg;
    private String dataHoraResp;

    public int getIdDuvida() {
        return idDuvida;
    }

    public void setIdDuvida(int idDuvida) {
        this.idDuvida = idDuvida;
    }

    public String getMsgDuvida() {
        return msgDuvida;
    }

    public void setMsgDuvida(String msgDuvida) {
        this.msgDuvida = msgDuvida;
    }

    public String getRespDuvida() {
        return respDuvida;
    }

    public void setRespDuvida(String respDuvida) {
        this.respDuvida = respDuvida;
    }

    public String getNomeProf() {
        return nomeProf;
    }

    public void setNomeProf(String nomeProf) {
        this.nomeProf = nomeProf;
    }

    public String getNomeAluno() {
        return nomeAluno;
    }

    public void setNomeAluno(String nomeAluno) {
        this.nomeAluno = nomeAluno;
    }

    public String getDataHoraMsg() {
        return dataHoraMsg;
    }

    public void setDataHoraMsg(String dataHoraMsg) {
        this.dataHoraMsg = dataHoraMsg;
    }

    public String getDataHoraResp() {
        return dataHoraResp;
    }

    public void setDataHoraResp(String dataHoraResp) {
        this.dataHoraResp = dataHoraResp;
    }
}
