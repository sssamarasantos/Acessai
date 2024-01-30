package com.example.acessai.classes;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import com.example.acessai.activitys.HomeActivity;
import com.example.acessai.activitys.LoginActivity;

import java.util.HashMap;

public class Session {
    SharedPreferences preferences;
    SharedPreferences.Editor editor;
    Context context;

    private static final String LOGIN = "Login";
    public static final String KEY_EMAIL = "email";
    public static final String KEY_PASSWORD = "password";

    @SuppressLint("CommitPrefEdits")
    public Session(Context context){
        this.context = context;
        preferences = context.getSharedPreferences("loginSession", Context.MODE_PRIVATE);
        editor = preferences.edit();
    }

    public void createSession(String email, String password){
        editor.putBoolean(LOGIN, true);
        editor.putString(KEY_EMAIL, email);
        editor.putString(KEY_PASSWORD, password);
        editor.commit();
    }

    public boolean isLoggedIn(){
        return preferences.getBoolean(LOGIN, false);
    }

    public HashMap<String, String> getUserDetails(){
        HashMap<String, String> user = new HashMap<>();
        user.put(KEY_EMAIL, preferences.getString(KEY_EMAIL, null));
        user.put(KEY_PASSWORD, preferences.getString(KEY_PASSWORD, null));

        return user;
    }

    public void logout(){
        editor.clear();
        editor.commit();
        Intent intent = new Intent(context, LoginActivity.class);
        context.startActivity(intent);
        ((HomeActivity) context).finish();
    }
}
