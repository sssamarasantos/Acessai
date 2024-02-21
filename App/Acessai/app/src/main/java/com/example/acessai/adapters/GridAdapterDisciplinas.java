package com.example.acessai.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.example.acessai.R;
import com.example.acessai.classes.Disciplina;

import java.util.ArrayList;

public class GridAdapterDisciplinas extends ArrayAdapter<Disciplina> {
    public GridAdapterDisciplinas(@NonNull Context context, ArrayList<Disciplina> disciplinaArrayList) {
        super(context, 0, disciplinaArrayList);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {

        View view = convertView;
        if (view == null) {
            // Layout Inflater inflates each item to be displayed in GridView.
            view = LayoutInflater.from(getContext()).inflate(R.layout.grid_adapter_disciplinas, parent, false);
        }

        Disciplina disciplina = getItem(position);
        TextView nomeDisciplina = (TextView) view.findViewById(R.id.lblDisc);

        if (disciplina != null) {
            nomeDisciplina.setText(disciplina.getNome());
        }

        return view;
    }
}
