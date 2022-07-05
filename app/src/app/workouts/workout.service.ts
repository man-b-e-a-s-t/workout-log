import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

import { Workout } from './workout.interface';

import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class WorkoutService {

  private workoutTypes: any;

  constructor(private http: HttpClient) { }

  getWorkouts(): Observable<Workout[]> {
    return this.http.get<Workout[]>(`${environment.api}/workout/read.php`);
  }

  getWorkout(workoutId: string): Observable<Workout> {
    return this.http.get<Workout>(`${environment.api}/workout/read.php?id=${workoutId}`);
  }

  createWorkout(workout: Workout): Observable<any> {
    const headers = new HttpHeaders().set('Content-Type', 'application/json; charset=UTF-8');
    return this.http.post(`${environment.api}/workout/create.php`, workout, { headers });
  }

  copyWorkout(workoutId: string): Observable<any> {
    const headers = new HttpHeaders().set('Content-Type', 'application/json; charset=UTF-8');
    return this.http.post(`${environment.api}/workout/copy.php`, workoutId, { headers });
  }
}
